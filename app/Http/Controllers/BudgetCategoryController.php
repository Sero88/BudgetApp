<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use Illuminate\Http\Request;

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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetCategory $budgetCategory)
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
        $budgetCategory->update( $this->validate_data() );

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
        //
    }


    private function validate_data(){
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
