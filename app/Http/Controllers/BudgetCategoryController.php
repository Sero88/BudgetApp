<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use Illuminate\Http\Request;
use App\Balance;

class BudgetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Balance $balance)
    {
        return redirect( route('balances.show', compact ('balance') ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Balance $balance)
    {
        $budget_category = new BudgetCategory();
        return view('budget_categories.create', compact('balance','budget_category') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Balance $balance)
    {
        $validated_data = $this->validateData();
        $validated_data['balance_id'] = $balance->id;

        BudgetCategory::create($validated_data);

        //return user to balance page
        return redirect(route("balances.show", compact('balance')) );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BudgetCategory  $budget_category
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance, BudgetCategory $budget_category)
    {
        $this->authorize('update', $budget_category);
        return view('budget_categories.show', compact('balance','budget_category') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BudgetCategory  $budget_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance, BudgetCategory $budget_category)
    {
        return view('budget_categories.edit', compact('balance','budget_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetCategory  $budget_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance, BudgetCategory $budget_category)
    {
        $budget_category->update( $this->validateData() );

        return redirect(route('budget-categories.show', compact('balance', 'budget_category')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetCategory  $budget_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance, BudgetCategory $budget_category)
    {
        //remove all associated transactions
        $budget_category->remove_transactions();

        $budget_category->delete();

        return redirect(route("balances.show", compact('balance')) );
    }


    private function validateData(){
       $validated_data = request()->validate([
            'budget_cat.*' => 'required',
            'budget_cat_amount.*' => 'required|numeric|min:0.01',
            'budget_cat_description.*' => 'nullable'
        ]);

       //get value of array
       $budget_cat['name'] = $validated_data['budget_cat'][0];
       $budget_cat['budget'] = $validated_data['budget_cat_amount'][0];
       $budget_cat['description'] = $validated_data['budget_cat_description'][0];

       return $budget_cat;
    }
}
