<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use App\Transaction;
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

        $trans= new Transaction();
        $user = Auth::user();
        $balances = $user->balances();
        $cats = [];

        foreach($balances->get() as $balance){
            $budget_cats = $balance->budget_categories();
            foreach($budget_cats->get() as $budget_cat){
                array_push($cats, ['name' => $budget_cat->name, 'id' => $budget_cat->id]);


            }
        }


        return view('home', compact('trans', 'cats'));
    }
}
