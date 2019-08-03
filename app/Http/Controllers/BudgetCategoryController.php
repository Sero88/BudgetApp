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
        //
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
        //
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
}
