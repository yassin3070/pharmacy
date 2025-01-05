<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\InitialPage;
use App\Models\User;
use App\Observers\BannerObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\InitialPageObserver;
use App\Observers\UserObserver;
use App\Rules\PhoneNumberRule;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
     
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category       ::observe(CategoryObserver::class);
        Banner         ::observe(BannerObserver::class);
        InitialPage    ::observe(InitialPageObserver::class);
        User           ::observe(UserObserver::class);



        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            $phoneNumberRule = new PhoneNumberRule();
            return $phoneNumberRule->passes($attribute, $value);
        });








        app()->singleton('lang', function (){
            if ( session() -> has( 'lang' ) )
                return session( 'lang' );
            else
                return 'ar';

        });

    }
}
