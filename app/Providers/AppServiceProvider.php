<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        $this->register();

        Gate::define('menu_company', function ($user) {
            if ($user->role == '0' || $user->role == '3') {
                return true;
            }
            return false;
        });

        Gate::define('manager_company', function ($user) {
            if ($user->role == '0') {
                return true;
            }
            return false;
        });

        Gate::define('menu_provider', function ($user) {
            if ($user->role == '1' || $user->role == '2'){
                return true;
            }
            return false;
        });
    }
}
