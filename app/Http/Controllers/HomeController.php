<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
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

        //instantiate a new transaction
        $trans= new Transaction();

        //get the current logged in user
        $user = Auth::user();

        //get the user balances and its budget categories
        $balances = $user->balances();
        $cats = [];
        foreach($balances->get() as $balance){
            $budget_cats = $balance->budget_categories();
            foreach($budget_cats->get() as $budget_cat){
                array_push($cats, $budget_cat);
            }
        }

        //get transaction types
        $types = TransactionType::all();


        return view('home', compact('trans', 'cats', 'types'));
    }
}
