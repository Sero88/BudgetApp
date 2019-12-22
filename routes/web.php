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

Route::get('/','HomeController@index');

Route::get('/obtain-access-key', 'ViewAccessController@index')->name('access.obtain_access_key');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('transactions', 'TransactionController')->middleware('auth');

Route::resource('recurring-transactions', 'RecurringTransactionController')->middleware('auth');

Route::resource('balances', 'BalanceController')->middleware('auth');

Route::resource('balances/{balance}/budget-categories', 'BudgetCategoryController')->middleware('auth');

Route::resource('payment-types', 'PaymentTypeController')->middleware('auth');

Route::get('/recurring-transactions-cron', 'RecurringTransactionController@cron')->name('cron.recurring_transactions');

Route::get('/settings', 'SettingsController@index');

Route::get('/budget-history', 'BudgetHistoryController@cron')->name('cron.budget_history');
