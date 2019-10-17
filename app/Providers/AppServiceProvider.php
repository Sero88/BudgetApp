<?php

namespace App\Providers;

use App\Services\RecurringTransaction;
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
    public function boot()
    {
        app()->singleton(RecurringTransaction::class, function(){
            return new RecurringTransactionCron();
        });
    }
}
