<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BudgetHistory extends Model
{
    protected $table = 'budget_history';
    protected $guarded = [];
    public $timestamps = false;

    public static function storePreviousMonth(){
        //get last month and year
        $lastMonth = Carbon::create('last month')->format('m');
        $year = Carbon::create('last month')->format('Y');

        //verify data hasn't been entered already, if so return
        if( BudgetHistory::verifyPreviousData($lastMonth, $year) ){
            echo 'data already archived';
            return;
        }

        // get each category transaction actuals sum
        //dd(BudgetCategory::all()->sum('budget'));
        foreach(SubBudgetCategory::all() as $subBudgetCategory){
            $budgetHistoryEntry = [
                'budget_cat_id' => $subBudgetCategory->budgetCategory->id,
                'sub_budget_category_id' => $subBudgetCategory->id,
                'month' => $lastMonth,
                'year' => $year,
                'budget' => $subBudgetCategory->budget,
            ];

            BudgetHistory::create($budgetHistoryEntry);

        };
    }

    private static function verifyPreviousData($month, $year){
        $previousData = BudgetHistory::where([
            ['month', '=', $month],
            ['year', '=', $year] ]
        );

        return $previousData->get()->isNotEmpty();
    }
}
