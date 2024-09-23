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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:users,mobile',
            'password' => 'required|min:6',
        ]);
        if (!$validator->fails()) {
            try {
                User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'mobile' => $request->input('mobile'),
                    'password' => Hash::make($request->input('password')),
                ]);
                return response()->json(['status_code' => 1, 'message' => 'User registered successfully'], 201);
            } catch (\Exception $e) {
                return response()->json(['status_code' => 0, 'message' => 'Unable to register user', 'error' => $e], 500);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()], 422);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
            'password' => 'required|string|min:6',
        ]);
        if (!$validator->fails()) {
            try {
                $credentials = $request->only('mobile', 'password');
                $remember = $request->has('remember') ? true : false;

                if (Auth::attempt($credentials, $remember)) {
                    $redirectUrl = 'dashboard';
                    if (auth()->user()->user_type == 'Admin') {
                        $redirectUrl = 'admin.dashboard';
                    }

                    return redirect()->route($redirectUrl);
                    return response()->json([
                        'status_code' => 1,
                        'message' => 'User logged in successfully',
                        'redirect_url' => $redirectUrl
                    ], 200);
                } else {
                    return response()->json(['status_code' => 0, 'message' => 'Invalid mobile or password'], 401);
                }
            } catch (\Exception $e) {
                return response()->json(['status_code' => 0, 'message' => 'something went wrong', 'error' => $e], 500);
            }
        } else {
            return response()->json(['status_code' => 2, 'message' => $validator->errors()->first()], 422);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
        return response()->json(['status_code' => 1, 'message' => 'User logged out successfully'], 200);
    }
}
