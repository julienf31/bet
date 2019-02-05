<?php

namespace App\Providers;

use App\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_ALL, 'fr');
        Carbon::setLocale('fr');
        Schema::defaultStringLength(191);
        view()->composer('template.theme', function($view)
        {
            if(Auth::user() && Auth::user()->hasRole('admin')){
                $view->with('notif', Report::where('seen',0)->count());
            }
        });
        view()->composer('template.new_theme', function($view)
        {
            if(Auth::user() && Auth::user()->hasRole('admin')){
                $view->with('notif', Report::where('seen',0)->count());
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
