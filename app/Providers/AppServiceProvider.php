<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserMailChange;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //check if new user registered an Email will be sent to him to verify his Email Address
        User::created(function($user)
        {
            retry(1, function() use($user)
            {
                Mail::to($user)->send(new UserCreated($user));
            }, 100);
        });

        /**
         * User::updated(function($user)
            {
            if($user->isDirty('email'))
            {
            retry(5, function() use($user)
            {
            Mail::to($user)->send(new UserMailChange($user));
            }, 100);
            }
            });
         */


    }
}
