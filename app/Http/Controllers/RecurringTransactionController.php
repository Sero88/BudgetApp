<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecurringTransactionRequest;
use App\RecurringTransaction;
use App\TransactionInterval;
use App\TransactionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RecurringTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recurring-transactions.index', ['recurringTransactions' => RecurringTransaction::all()->where('owner_id','=', Auth::user()->id)->sortByDesc('date_made')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recurringTransaction = new RecurringTransaction();
        $recurringTransaction = get_old_recurring_trans_data($recurringTransaction);
        //get transaction types
        $types = TransactionType::all();

        //get budget cats
        $user = Auth::user();
        $cats = $user->budget_categories;

        //get intervals
        $intervals = TransactionInterval::all();

        //return view
        return view('recurring-transactions.create', compact('recurringTransaction', 'types', 'cats', 'intervals'));
    }

    /**
     * Store a newly created resource in storage.b
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecurringTransactionRequest $request)
    {

        //dd(Carbon::now()->add(15, 'day'));
        $data = $request->validated();


        $user_id  = Auth::user()->id;
        $data['owner_id'] = $user_id;

        $data['day_of_month'] = dd(Carbon::create(Carbon::create($data['day_of_month'])->toDateString()));




        $recurring = RecurringTransaction::create($data);

        dd($recurring);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
