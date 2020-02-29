<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use App\Http\Requests\BudgetCategoryRequest;
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
        $this->authorize('update', $balance);
        return redirect( route('balances.show', compact ('balance') ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Balance $balance)
    {
        $this->authorize('update', $balance);
        $budgetCategory = new BudgetCategory();
        $budgetCategory = get_old_budget_data($budgetCategory);
        return view('budget_categories.create', compact('balance','budgetCategory') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BudgetCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetCategoryRequest $request, Balance $balance)
    {

        $this->authorize('update', $balance);

        //$validated_data = $this->validateData();
        $validated_data = $request->conformValidatedData();
        $validated_data['balance_id'] = $balance->id;

        BudgetCategory::create($validated_data);

        //return user to balance page
        return redirect(route("balances.show", compact('balance')) );

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
        return view('budget_categories.show', compact('balance','budgetCategory') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance, BudgetCategory $budgetCategory)
    {
        $this->authorize('update', $budgetCategory);
        return view('budget_categories.edit', compact('balance','budgetCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BudgetCategoryRequest  $request
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetCategoryRequest $request, Balance $balance, BudgetCategory $budgetCategory)
    {
        $this->authorize('update', $budgetCategory);
        $budgetCategory->update( $request->conformValidatedData() );

        return redirect(route('budget-categories.show', compact('balance', 'budgetCategory')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BudgetCategory  $budgetCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance, BudgetCategory $budgetCategory)
    {
        $this->authorize('update', $budgetCategory);

        //remove all associated transactions
        $budgetCategory->remove_transactions();

        $budgetCategory->delete();

        return redirect(route("balances.show", compact('balance')) );
    }

    public function subBudgetCategorySelector(Balance $balance, BudgetCategory $budgetCategory){
        return view('budget_categories.sub-budget-categories-selector', compact('balance', 'budgetCategory'));
    }
}
