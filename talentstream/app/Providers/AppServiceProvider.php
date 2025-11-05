<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Message;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
    {
        User::observe(UserObserver::class);
        View::composer('*', function ($view) {
        if (Auth::check()) {
            $unreadMessages = Message::where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->get();

            $view->with('unreadMessages', $unreadMessages);
        }
    });
    }


    protected $policies = [
    \App\Models\JobAlert::class => \App\Policies\JobAlertPolicy::class,
];

}
