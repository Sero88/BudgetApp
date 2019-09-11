<?php

namespace App\Http\Controllers;

use App\Balance;
use App\BudgetCategory;
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
        //todo add policy for balances

        $balance = new Balance();
        $this->get_old_data();

        $budgetCategory = new BudgetCategory();

        return view('balances.create', compact('balance', 'budgetCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illu public function get_old_data(){
     * $this->name = !empty(old('name')) ? old('name') : '';
     * $this->description = !empty(old('description')) ? old('description') : '';
     * $this->amount = !empty(old('amount')) ? old('amount') : '';
     * $this->owner_id = !empty(old('owner_id')) ? old('ownder_id') : '';
     *
     * }minate\Http\Response
     */
    public function store(Request $request)
    {

        //validate balance info
        $user_input = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'amount' => 'required|numeric|min:0.01',
//                'budget_cat' => 'size:2' in this case we require array to be of 2, but since we require all cat_names on the line below , we do not need to match amounts
                'budget_cat.*' => 'required',
                'budget_cat_amount.*' => 'required|numeric|min:0.01',
                'budget_cat_description.*' => 'nullable'
            ]
        );

        $user_input['owner_id'] = Auth::user()->id;


        //create new balance
        $new_balance = Balance::create([
            'name' => $user_input['name'],
            'description' => $user_input['description'],
            'amount' => $user_input['amount'],
            'owner_id' => Auth::user()->id
        ]);

        //create budget categories
        for ($i = 0; $i < count($user_input['budget_cat']); $i++) {
            $new_cat = [];
            $new_cat['name'] = $user_input['budget_cat'][$i];
            $new_cat['description'] = !empty($user_input['budget_cat_description'][$i]) ? $user_input['budget_cat_description'][$i] : '';
            $new_cat['budget'] = $user_input['budget_cat_amount'][$i];
            $new_cat['balance_id'] = $new_balance->id;

            BudgetCategory::create($new_cat);
        }


        session()->flash('message', 'New balance and budget categories created!');

        return redirect('/balances');

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

        $transactions = $balance->transactions()->get();

        return view('balances.show', compact('balance', 'transactions'));
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        $this->authorize('update', $balance);
        $new_input = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric|min:0.01',
        ]);
        $balance->update($new_input);

        session()->flash('message', 'Balance was updated successfully.');

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

        //delete delete children relations tied to balances first then balance
        $balance->transactions()->delete();
        $balance->budget_categories()->delete();
        $balance->delete();

        session()->flash('message', 'Balance deleted successfully');

        return redirect('/balances');
    }


    private function get_old_data()
    {
        $this->name = !empty(old('name')) ? old('name') : '';
        $this->description = !empty(old('description')) ? old('description') : '';
        $this->amount = !empty(old('amount')) ? old('amount') : '';
        $this->owner_id = !empty(old('owner_id')) ? old('ownder_id') : '';

    }
}
