<?php

namespace App\Http\Controllers;

use App\Balance;
use App\BudgetCategory;
use App\Http\Requests\SubBudgetCategoryRequest;
use App\SubBudgetCategory;
use Illuminate\Http\Request;

class SubBudgetCategoryController extends Controller
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
    public function create(Balance $balance, BudgetCategory $budgetCategory)
    {
           $this->authorize('update', $budgetCategory);
           $subBudgetCategory = new SubBudgetCategory();
           $subBudgetCategory = get_old_sub_budget_category_data($subBudgetCategory);
           return view('sub_budget_categories.create', compact('balance', 'budgetCategory', 'subBudgetCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubBudgetCategoryRequest $request, Balance $balance, BudgetCategory $budgetCategory)
    {
        $this->authorize('update', $budgetCategory);


        $validated_data = $request->validated();
        $validated_data['budget_category_id'] = $budgetCategory->id;

        SubBudgetCategory::create($validated_data);

        //return user to balance page
        return redirect(route("budget-categories.show", compact('balance', 'budgetCategory')) );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubBudgetCategory  $subBudgetCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance, BudgetCategory $budgetCategory, SubBudgetCategory $subBudgetCategory)
    {
        return view('sub_budget_categories.show', compact('balance', 'budgetCategory', 'subBudgetCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubBudgetCategory  $subBudgetCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance, BudgetCategory $budgetCategory, SubBudgetCategory $subBudgetCategory)
    {
        return view('sub_budget_categories.edit', compact('balance', 'budgetCategory', 'subBudgetCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubBudgetCategory  $subBudgetCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubBudgetCategoryRequest $request, Balance $balance, BudgetCategory $budgetCategory, SubBudgetCategory $subBudgetCategory)
    {
        $this->authorize('update', $budgetCategory);
        $subBudgetCategory->update( $request->validated() );

        return redirect(route("budget-categories.show", compact('balance', 'budgetCategory')) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubBudgetCategory  $subBudgetCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance, BudgetCategory $budgetCategory, SubBudgetCategory $subBudgetCategory)
    {
        $this->authorize('update', $budgetCategory);

        $subBudgetCategory->delete();

        return redirect(route("budget-categories.show", compact('balance', 'budgetCategory')) );
    }
}
