<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Settings;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session; // Add this for using Session

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $setting = Settings::first();
            $view->with('setting', $setting);
        });

        $this->mainData();

        $this->notificationsData();
    }

    public function mainData()
    {
        View::composer('layouts.app', function ($view) {

            if (Session::has('loginId')) {
                $loggedInUserId = Session::get('loginId');
                $admin = Admin::findOrFail($loggedInUserId);
                $view->with('admin', $admin);
            } else {
                $view->with('admin', null);
            }
        });
    }

    public function notificationsData()
    {
        View::composer('layouts.app', function ($view) {
            $notifications = Notification::all();
            $view->with('notifications', $notifications);
        });
    }
}
