<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        User::observe(UserObserver::class);

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                // Latest messages in conversations
                $latestMessages = Message::with('sender', 'conversation')
                    ->whereHas('conversation', function ($q) use ($userId) {
                        $q->where('user_one', $userId)
                          ->orWhere('user_two', $userId);
                    })
                    ->latest()
                    ->take(5)
                    ->get();

                // Unread messages (sent by others)
                $unreadMessages = Message::whereHas('conversation', function ($q) use ($userId) {
                        $q->where('user_one', $userId)
                          ->orWhere('user_two', $userId);
                    })
                    ->where('sender_id', '!=', $userId)
                    ->where('is_read', false)
                    ->get();

                $view->with([
                    'latestMessages' => $latestMessages,
                    'unreadMessages' => $unreadMessages,
                ]);
            }
        });
    }

    protected $policies = [
        \App\Models\JobAlert::class => \App\Policies\JobAlertPolicy::class,
    ];
}
