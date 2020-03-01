<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Return HTML for Sub Budget Categories
     * @param BudgetCategory $budgetCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subBudgetCategorySelector(BudgetCategory $budgetCategory){
        return view('budget_categories._sub-budget-categories-selector', compact('budgetCategory'));
    }
}
