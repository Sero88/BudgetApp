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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Balance $balance)
    {
        $budgetCategory = new BudgetCategory();
        return view('budget_categories.create', compact('balance','budgetCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Balance $balance, Request $request)
    {
        $validated_data = $this->validateData();
        $validated_data['balance_id'] = $balance->id;

        BudgetCategory::create($validated_data);

        //return user to balance page
        return redirect(route("balances.show", ['id'=>$balance->id]) );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance, BudgetCategory $budgetCategory)
    {
        $this->authorize('update', $budgetCategory);
        return view('budget_categories.show', compact('budgetCategory') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetCategory $budgetCategory)
    {

        return view('budget_categories.edit', compact('budgetCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetCategory $budgetCategory)
    {
        $budgetCategory->update( $this->validateData() );

        return redirect(route('budget-categories.show', ['id' => $budgetCategory->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetCategory $budgetCategory)
    {

        $balance = $budgetCategory->balance;

        //remove all associated transactions
        $budgetCategory->remove_transactions();

        $budgetCategory->delete();

        return redirect(route("balances.show", ['id'=>$balance->id]) );
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
