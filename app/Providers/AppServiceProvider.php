<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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
    
    public function boot()
    {
        $locale = session('locale');
    
        if (auth()->check()) {
            $locale = auth()->user()->lang ?? $locale;
        }
    
        if ($locale) {
            App::setLocale($locale);
        }
    }    
}
