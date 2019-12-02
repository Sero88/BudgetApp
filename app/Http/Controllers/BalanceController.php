<?php

namespace App\Http\Controllers;

use App\Balance;
use App\BudgetCategory;
use App\Http\Requests\BalanceRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = Auth::user()->id;

        $balances = Balance::where('owner_id', $user_id)->get();

        return view('balances.index', compact('balances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        //todo - only 1 balance allowed now - later on version 2 will allow multiple balances
        if( count($user->balances) >= 1 ){
            return redirect( route('balances.index') );
        }

        $balance = new Balance();
        $balance = get_old_balance_data($balance);

        $budgetCategory = new BudgetCategory();

        return view('balances.create', compact('balance', 'budgetCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BalanceRequest
     * @return redirect
     * $this->name = !empty(old('name')) ? old('name') : '';
     * $this->description = !empty(old('description')) ? old('description') : '';
     * $this->amount = !empty(old('amount')) ? old('amount') : '';
     * $this->owner_id = !empty(old('owner_id')) ? old('ownder_id') : '';
     *
     * }minate\Http\Response
     */
    public function store(BalanceRequest $request)
    {
        //validate balance info
        $user_input = $request->validated();
        $user_input['owner_id'] = Auth::user()->id;

        //create new balance
        $balance = Balance::create($user_input);

        //create budget categories
        /*for ($i = 0; $i < count($user_input['budget_cat']); $i++) {
            $new_cat = [];
            $new_cat['name'] = $user_input['budget_cat'][$i];
            $new_cat['description'] = !empty($user_input['budget_cat_description'][$i]) ? $user_input['budget_cat_description'][$i] : '';
            $new_cat['budget'] = $user_input['budget_cat_amount'][$i];
            $new_cat['balance_id'] = $new_balance->id;

            BudgetCategory::create($new_cat);
        }*/

        session()->flash('message', 'New balance created! Create budget categories for ' . $balance->name );
        return redirect( route('budget-categories.create', compact('balance') ) );

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        $this->authorize('update', $balance);

        return view('balances.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        $this->authorize('update', $balance);
        return view('balances.edit', compact('balance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\BalanceRequest $request
     * @param \App\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function update(BalanceRequest $request, Balance $balance)
    {
        $this->authorize('update', $balance);

        $balance->update($request->validated());

        session()->flash('message', $balance->name . ' was updated successfully.');

        return redirect('/balances');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {

        $this->authorize('update', $balance);

        //delete children relations tied to balances first then balance
        $balance->transactions()->delete();
        $balance->budgetCategories()->delete();
        $balance->delete();

        session()->flash('message', 'Balance deleted successfully');

        return redirect('/balances');
    }
}
