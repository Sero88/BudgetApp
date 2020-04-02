<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* app()->bind('App\MyItem', function(){
    return new App\MyItem('123key');
}); */



Auth::routes();


Route::get('/obtain-access-key', 'ViewAccessController@index')->name('access.obtain_access_key');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','HomeController@index');

Route::get('/recurring-transactions-cron', 'RecurringTransactionController@cron')->name('cron.recurring_transactions');

Route::get('/settings', 'SettingsController@index');

Route::get('/budget-history', 'BudgetHistoryController@cron')->name('cron.budget_history');


Route::middleware(['auth'])->group(function (){
    Route::resource('recurring-transactions', 'RecurringTransactionController');

    Route::resource('balances', 'BalanceController');

    Route::resource('balances/{balance}/budget-categories', 'BudgetCategoryController');

    Route::resource('balances/{balance}/budget-categories/{budget_category}/sub-budget-categories', 'SubBudgetCategoryController');

    Route::resource('payment-types', 'PaymentTypeController');

    Route::resource('transactions', 'TransactionController');

    Route::get('/api/reports/annual/{year?}', 'APIController@annualReport')->name('api.annual_report');

    Route::get('/api/reports/monthly/{year}/{month}', 'APIController@monthlyReport')->name('api.monthly_report');

    Route::get('html/budget-categories/{budget_category}/sub-budget-categories/{sub_budget_category?}', 'APIController@subBudgetCategorySelector')->name('selector.sub-budget-categories');

    Route::get('reports/annual', 'ReportController@annual')->name('reports.annual');

});





