<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Validator::extend('is_phone', function ($attribute, $value, $parameters) {
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}
}
