<?php

namespace App\Observers;

use App\Models\Balance;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        \Log::info('User created: ' . $user->email);

        Balance::create([
            'user_id' => $user->id,
            'wallet1' => 0,
            'wallet2' => 0,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
        \Log::info('User updated: ' . $user->email);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
        \Log::info('User deleted: ' . $user->email);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
        \Log::info('User restored: ' . $user->email);
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
        \Log::info('User force delete: ' . $user->email);
    }
}
