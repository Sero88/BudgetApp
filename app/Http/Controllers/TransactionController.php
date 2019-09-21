<?php

namespace App\Http\Controllers;

use App\Balance;
use App\BudgetCategory;
use App\Transaction;
use App\TransactionType;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //get user input
        $new_transaction = $this->get_validated_data();


        //get user id and time
        $new_transaction['owner_id'] = Auth::user()->id;
        $new_transaction['date_made'] = now();

        //save the transaction
        $saved_trans = Transaction::create($new_transaction);


        //get the transaction amount
        $trans_amount = get_trans_amount($saved_trans);

        //get its corresponding balance
        $balance = $saved_trans->budget_category->balance;

        //update balance amount
        $balance->update(['amount' => $balance->amount + $trans_amount ]);

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
        $types = TransactionType::all();

        return view('transactions.edit', compact('transaction', 'cats','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {

        //can user update this transaction
        $this->authorize('update', $transaction);

        //get old amount and new trans data
        $old_amount = $transaction->amount;
        $data = $this->get_validated_data();

        //run update
        $transaction->update($data);

        //update balance if amount is not the same
        if($old_amount != $data['amount']){
            //update balance
            $balance = $transaction->budget_category->balance;
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


        $deleted = $transaction->delete();

        if($deleted){
            session()->flash('message', 'You have successfully deleted the transaction');
        } else {
            session()->flash('message', 'Unable to delete transaction');
        }
        return back();
    }

    private function get_validated_data(){
        return request()->validate(
            [
                'amount' => 'required|numeric|min:0.01|',
                'type_id' => 'required',
                'budget_cat_id' => 'required',
                'description' => 'nullable'
            ]
        );
    }


}
