<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        $base_path = parse_url(url('/'), PHP_URL_PATH);
        if ($base_path) {
            Livewire::setScriptRoute(function ($handle) use ($base_path) {
                return Route::get($base_path . '/livewire/livewire.js', $handle);
            });
            Livewire::setUpdateRoute(function ($handle) use ($base_path) {
                return Route::post($base_path . '/livewire/update', $handle);
            });
        }
    }
}
