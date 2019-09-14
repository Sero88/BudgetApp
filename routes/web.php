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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('transactions', 'TransactionController');

Route::resource('balances', 'BalanceController');

Route::resource('balances/{balance}/budget-categories', 'BudgetCategoryController');
