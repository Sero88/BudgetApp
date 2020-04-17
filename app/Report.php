<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Report
{
    public static function annual($year){
        $data = [];

        //get monthly totals - exclude current month
        $monthlyTotals = Transaction::select(DB::raw('SUM(amount) as total, date_made'))
            ->where([
                ['date_made', 'like', $year . '-%'],
                ['date_made', '<', Carbon::now()->format('Y-m-01')],
                ['type_id', '=', TransactionType::getId('credit') ]
            ])
            ->groupBy('date_made')
            ->get();

        //get monthly budgets
        //select SUM(budget) as total, month from budget_history where year = 2020 group by month order by month asc;
        $budgetTotals = BudgetHistory::select(DB::raw('SUM(budget) as total, month'))
            ->where('year', '=', $year)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        //get year's actuals sum
        $data[$year]['actualsTotal'] = $monthlyTotals->sum('total');

        //get year's average spending
        $data[$year]['monthlyAverage'] = $monthlyTotals->avg('total');

        //build data array
        foreach($budgetTotals as $budgetTotal){
            $actuals = $monthlyTotals->filter(function($value, $key) use ($budgetTotal){
                return Carbon::create($value->date_made)->format('n') == $budgetTotal->month;
            });


            if($actuals->isNotEmpty()) {
                $data[$year]['monthly'][$budgetTotal->month] = ['actuals' => format_number($actuals->sum('total')), 'budget' => $budgetTotal->total];
            }
        }


        return json_encode($data);
    }

    public static function monthlyCategories($year, $month){

        $data = [];

        //build data array
        foreach(BudgetCategory::withTrashed()->get() as $budgetCategory){
            $actuals = $budgetCategory->monthlyTransactions('credit', $year, Carbon::create($year, $month)->format('F') )->sum('amount');

            $budget = $budgetHistory = BudgetHistory::where([
                ['budget_cat_id', '=', $budgetCategory->id],
                ['month', '=', $month],
                ['year', '=', $year]
            ])->get()->sum('budget');

            if($actuals || $budget){
                $data[$year][$month][$budgetCategory->id] = [
                    'name' => $budgetCategory->name,
                    'actuals' => $actuals ?? 0,
                    'budget' => $budget ?? 0,
                ];
            }

        }

        return json_encode($data);
    }


    //todo - think in terms of api and in terms of reports. When api is requested data, what do we show. When report is requested data what do we show?
    public static function monthlySubCategories($year, $month, $budgetCategoryId){
        $data = [];
        $actualsTotalWithNoSubCategories = Transaction::select(DB::raw('sum(amount) as total'))
            ->where([
                ['budget_cat_id', '=', $budgetCategoryId],
                ['sub_budget_category_id', '=' , NULL],
                ['date_made', 'like', Carbon::create($year, $month)->format('Y-m-%')],
                ['type_id', '=', TransactionType::getId('credit') ]
            ])->get()->first()->total;

        if($actualsTotalWithNoSubCategories){
            $data[$year][$month][$budgetCategoryId]['0'] = self::monthlySubcategoriesArray('unsubcategorized', $actualsTotalWithNoSubCategories, 0);
        }

        //get subBudgetCategories and build data variable
        $subBudgetCategories = SubBudgetCategory::withTrashed()->where('budget_category_id', '=', $budgetCategoryId)->get();

        foreach( $subBudgetCategories as $subBudgetCategory){
                $actuals = $subBudgetCategory->monthlyTransactions('credit', $year, Carbon::create($year, $month)->format('F') )->sum('amount');

                $budgetHistory = BudgetHistory::where([
                    ['sub_budget_category_id', '=', $subBudgetCategory->id],
                    ['month', '=', $month],
                    ['year', '=', $year]
                ])->get()->first();


                if($actuals || $budgetHistory){
                    $data[$year][$month][$budgetCategoryId][$subBudgetCategory->id] = self::monthlySubcategoriesArray($subBudgetCategory->name, $actuals ?? 0, $budgetHistory->budget ?? 0);
                }

        }

        if( empty($data) ){

            $data[$year][$month][$budgetCategoryId] = '';
        }

        return json_encode($data);
    }

    public static function availableYears(){
        return BudgetHistory::select(DB::raw('distinct year'))->get();
    }

    private static function monthlySubcategoriesArray($name, $actuals, $budget)
    {
        return compact(['name', 'actuals', 'budget']);
    }
}

