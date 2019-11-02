<?php

namespace App\Http\Controllers;

use App\BudgetCategory;

use App\MyItem;
use App\PaymentType;
use App\Transaction;
use App\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get the current logged in user
        $user = Auth::user();

        //todo - to begin we'll start with one balance, version 2 will allow multiple balances
        $balance = $user->balances->first();


        if( empty($balance) ){
            return redirect( route('balances.create'));
        }

        //instantiate a new transaction
        $transaction= new Transaction();

        //get old values if they exist
        $transaction = get_old_trans_data($transaction);



        //get the user balances and its budget categories
        $cats = $user->budget_categories->sortby('name');






        /*$cats = [];
        foreach($balances->get() as $balance){
            $budget_cats = $balance->budget_categories();
            foreach($budget_cats->get() as $budget_cat){
                array_push($cats, $budget_cat);
            }
        }*/

        //get transaction types
        $transactionTypes = TransactionType::all();

        //get payment types
        $paymentTypes = PaymentType::all()->sortBy('name');

        return view('home', compact('transaction','balance', 'cats', 'transactionTypes', 'paymentTypes'));
    }
}
