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
            if ($user = Auth::user()) {
                $notiTableExists = Schema::hasTable('notifications');
                if ($notiTableExists) {
                    $notification = Notification::where('user_id', $user->id)->where('read_flag', 0)->latest()->get();
                    $unreadCount = 0;
                    foreach ($notification as $index => $noti) {
                        if ($noti->read_flag == 0) {
                            $unreadCount++;
                        }
                    }
                    $notification->unreadCount = $unreadCount;
                }
            }
            view()->share('notification', $notification);
        });
    }
}
