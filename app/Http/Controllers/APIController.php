<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use App\Error;
use App\Report;
use App\SubBudgetCategory;
use App\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class APIController extends Controller
{
    /**
     * Return HTML for Sub Budget Categories
     * @param BudgetCategory $budgetCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subBudgetCategorySelector(BudgetCategory $budgetCategory, SubBudgetCategory $subBudgetCategory){
        return view('budget_categories._sub-budget-categories-selector', compact('budgetCategory', 'subBudgetCategory'));
    }

    public function annualReport( $year = null){
        if( empty($year) ){
            $year = Carbon::now()->year;
        } else{
            $year = Validator::validateNumber($year);
        }

        return $year ? Report::annual($year) : Error::showError(400, 'Invalid input. Year must be a number');
    }

    public function  monthlyReport($year = null, $month = null, $budgetCategoryId = null){
        $year = Validator::validateNumber($year);
        $month = Validator::validateNumber($month);
        $budgetCategory = Validator::validateNumber($budgetCategoryId) ? BudgetCategory::withTrashed()->find($budgetCategoryId) : false;

        if( !($month && $year) ){
            return Error::showError(400, 'Invalid input. Year and month must be a number.');
        } elseif($budgetCategoryId && !$budgetCategory){
            return Error::showError(404, "Unable to find the specified budget category.");
        } elseif($budgetCategory){
            return Report::monthlySubCategories($year, $month, $budgetCategoryId);
        } else{
            return Report::monthlyCategories($year, $month);
        }
    }

}
