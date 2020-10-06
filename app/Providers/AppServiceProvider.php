<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\ServiceProvider;

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
    public function boot(GateContract $gate, Charts $charts)
    {
        //
        $charts->register([
            \App\Charts\SampleChart::class,
            \App\Charts\UsersChart::class,
            \App\Charts\RequestsChart::class
        ]);

        $gate->define('isAdmin', function($user){
            return $user->profile_type == "App\Admin";
        });

        $gate->define('isIndependentCollector', function($user){
            return $user->profile_type == "App\IndependentCollector";
        });

        $gate->define('isResident', function($user){
            return $user->profile_type == "App\Resident";
        });

        $gate->define('isBuyBackCenter', function($user){
            return $user->profile_type == "App\BuyBackCenter";
        });

        $gate->define('isPickItUpCenter', function($user){
            return $user->profile_type == "App\PickItUpCenter";
        });



        
    }
}
