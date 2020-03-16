<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Report
{
    public static function annual($year){
        $data = [];

        //get monthly totals - exclude current month
        $monthlyTotals = Transaction::select(DB::raw('SUM(amount) as total, date_format(cast(date_made as DATE), \'%c\') as month'))
            ->where([
                ['date_made', 'like', $year . '-%'],
                ['date_made', '<', Carbon::now()->format('Y-m')]
            ])
            ->groupBy('month')
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
                return $value->month == $budgetTotal->month;
            });

            if($actuals->isNotEmpty()){
                $data[$year]['monthly'][$budgetTotal->month] = ['actuals' => $actuals->first()->total, 'budget' => $budgetTotal->total];
            }

        }

        echo json_encode($data);
    }
}
