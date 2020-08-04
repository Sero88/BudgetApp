<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Transaction' => 'App\Policies\TransactionPolicy',
        'App\RecurringTransaction' => 'App\Policies\RecurringTransactionPolicy',
        'App\Balance' => 'App\Policies\BalancePolicy',
        'App\BudgetCategory' => 'App\Policies\BudgetCategoryPolicy',
        'App\SubBudgetCategory' => 'App\Policies\BudgetCategoryPolicy',
        //'App\PaymentType' => 'App\Policies\PaymentTypePolicy', //don't need to add this, laravel knows by the name of Policy (tested)
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
