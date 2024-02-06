<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message; 


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
         // Define a view composer for all admin views
         View::composer('admin.*', function ($view) {
            // Retrieve unread messages
            $unreadMessages = Message::where('isRead', false)->get();

            // Share the unread messages data with the view
            $view->with('unreadMessages', $unreadMessages);
        });

       
    }
}
