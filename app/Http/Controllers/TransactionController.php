<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\PaymentType;
use App\Transaction;
use App\TransactionType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('transactions.index', ['transactions' => Transaction::all()->where('owner_id','=', Auth::user()->id)->sortByDesc('date_made')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {


        //get user input
        $new_transaction = $request->validated();

        //get user id and time
        $new_transaction['owner_id'] = Auth::user()->id;
        $new_transaction['date_made'] = create_datetime($new_transaction['date_made']);

        //save the transaction
        Transaction::createTransaction($new_transaction);

        //user feedback
        $request->session()->flash('message','Transaction created successfully.');

        //redirect
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        //abort_unless(\Gate::allows('update',$transaction), 403);

        $transaction = get_old_trans_data($transaction);

        //get the current logged in user
        $user = Auth::user();

        //get the user balances and its budget categories
        $cats = $user->budget_categories()->get();
        $transactionTypes = TransactionType::all();

        //get the balance
        $balance = $transaction->budgetCategory->balance;

        //get payment types
        $paymentTypes = PaymentType::all()->sortBy('name');

        //get sub category
        $subBudgetCategoryId = $transaction->subBudgetCategory->id ?? '';


        return view('transactions.edit', compact('transaction', 'cats','transactionTypes','balance', 'paymentTypes', 'subBudgetCategoryId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TransactionRequest  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {

        //can user update this transaction
        $this->authorize('update', $transaction);

        //get old amount and new trans data
        $old_amount = $transaction->amount;
        $data = $request->validated();
        $data['date_made'] = create_datetime($data['date_made']);

        //run update
        $transaction->update($data);

        //update balance if amount is not the same
        if($old_amount != $data['amount']){
            //update balance
            $balance = $transaction->budgetCategory->balance;
            $balance->update(['amount' => $balance->amount + ($old_amount - $data['amount'])]);
        }

        session()->flash('message','Transaction successfully updated.');


        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $deleted = Transaction::deleteTransaction($transaction);

        if($deleted){
            session()->flash('message', 'You have successfully deleted the transaction');
        } else {
            session()->flash('message', 'Unable to delete transaction');
        }
        return back();
    }
}
