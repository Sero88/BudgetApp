<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecurringTransactionRequest;
use App\RecurringTransaction;
use App\Services\RecurringTransactionCron;
use App\TransactionInterval;
use App\TransactionType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class RecurringTransactionController extends Controller
{

    public function __construct(){
        $this->middleware('cron.key', ['only' => ['cron']]);
    }

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
     * @param  App\Http\Requests\RecurringTransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecurringTransactionRequest $request)
    {

        $data = $request->validated();

        $user_id  = Auth::user()->id;
        $data['owner_id'] = $user_id;
        $data['day_of_month'] = Carbon::create($data['day_of_month'])->toDateString();

        $recurring = RecurringTransaction::create($data);

        return redirect( route('recurring-transactions.index') );

    }

    /**
     * Display the specified resource.
     *
     * @param  RecurringTransaction $recurringTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(RecurringTransaction $recurringTransaction)
    {
        return redirect(route('recurring-transactions.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  RecurringTransaction $recurringTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(RecurringTransaction $recurringTransaction)
    {
        $this->authorize('update', $recurringTransaction);

        //get transaction types
        $types = TransactionType::all();

        //get budget cats
        $user = Auth::user();
        $cats = $user->budget_categories;

        //get intervals
        $intervals = TransactionInterval::all();

        return view('recurring-transactions.edit', compact('recurringTransaction', 'types', 'cats', 'intervals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\RecurringTransactionRequest $request
     * @param  RecurringTransaction $recurringTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(RecurringTransactionRequest $request, RecurringTransaction $recurringTransaction)
    {
        $this->authorize('update', $recurringTransaction);
        $data = $request->validated();
        $recurringTransaction->update($data);

        return redirect(route('recurring-transactions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RecurringTransaction $recurringTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecurringTransaction $recurringTransaction)
    {
        $this->authorize('update', $recurringTransaction);
        $recurringTransaction->delete();

        return redirect(route('recurring-transactions.index'));
    }

    public function cron(RecurringTransaction $recurringTransaction){
        $this->middleware('cron.key');

        //get recurring transactions

        $recurringTransaction->executeUpcomingTransactions($recurringTransaction->upcomingTransactions());


    }
}
