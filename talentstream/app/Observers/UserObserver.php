<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Notification;

class UserObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        Notification::create([
            'user_id' => $user->id,
            'type' => 'Profile',
            'message' => 'Your profile information was updated successfully.',
        ]);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user)
    {
        Notification::create([
            'user_id' => $user->id,
            'type' => 'Welcome',
            'message' => 'Welcome to our platform, ' . $user->name . '!',
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user)
    {
        Notification::create([
            'user_id' => $user->id,
            'type' => 'Account',
            'message' => 'Your account has been deleted.',
        ]);
    }
}
