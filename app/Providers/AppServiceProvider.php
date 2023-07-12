<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Validator;
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
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        Gate::define('admin', function (User $user) {
            $admins = array("asamet273446@gmail.com");

            if($user) {
                if(!in_array($user->email, $admins))
                {
                    return false;
                } else {
                    return true;
                }
            }
            else {
                return false;
            }
        });
    }
}
