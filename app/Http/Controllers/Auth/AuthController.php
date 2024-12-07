<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:users,mobile',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (!$validator->fails()) {
            try {
                User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'mobile' => $request->input('mobile'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]);

                return redirect()->route('login')
                ->with('success', 'User registered successfully. Please log in.');
            } catch (\Exception $e) {
                return redirect()->back()
                ->with('error', 'Unable to register user. Please try again.')->withInput();
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function login(Request $request) {
        $username = $request->input('username');
        $isEmail = filter_var($username, FILTER_VALIDATE_EMAIL);

        $validator = Validator::make($request->all(), [
            'username' => $isEmail ? 'required|email' : 'required|digits:10',
            'password' => 'required|string|min:6',
        ]);
        if (!$validator->fails()) {
            try {
                $credentials = $isEmail
                ? ['email' => $username, 'password' => $request->input('password')]
                : ['mobile' => $username, 'password' => $request->input('password')];
                $remember = $request->has('remember') ? true : false;

                if (Auth::attempt($credentials, $remember)) {
                    // if (auth()->user()->user_type == 'Admin') {
                    //     return redirect()->route('admin.dashboard')->with('success', 'You are logged in.');
                    // }
                    return redirect()->route('dashboard')->with('success', 'You are logged in.');
                } else {
                    return redirect()->back()->with('error', 'Invalid username or password.')->withInput();
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Unable to login, Server error.');
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function logout(Request $request){
        Auth::logout();

        return redirect()->route('login');
    }
}
