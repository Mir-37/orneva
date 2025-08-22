<?php

namespace App\Providers;

use App\Models\BusinessDetail;
use Illuminate\Support\ServiceProvider;

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
        $businessDetails = BusinessDetail::all()->pluck('value', 'key')->toArray();

        view()->share('businessDetails', $businessDetails);
    }
}
