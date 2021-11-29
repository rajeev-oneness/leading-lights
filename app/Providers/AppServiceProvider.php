<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function () {
            $notification = [];
            $notiTableExists = Schema::hasTable('notifications');

            if ($notiTableExists) {
                if ($user = Auth::user()) {
                    $notification = Notification::where('user_id', $user->id)->latest()->get();
                    $unreadCount = 0;
                    foreach ($notification as $index => $noti) {
                        if ($noti->read_flag == 0) {
                            $unreadCount++;
                        }
                    }
                    $notification->unreadCount = $unreadCount;
                }

                if ($user = Auth::user()) {
                    $notification = Notification::where('class_id', $user->class)->latest()->get();
                    $unreadCount = 0;
                    foreach ($notification as $index => $noti) {
                        if ($noti->read_flag == 0) {
                            $unreadCount++;
                        }
                    }
                    $notification->unreadCount = $unreadCount;
                }
            }
            // dd($notification);
            // view()->share('APP_data', $APP_data);
            view()->share('notification', $notification);
        });
    }
}
