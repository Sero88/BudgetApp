<?php

namespace App;

use App\TransactionType;

trait Monthly
{
    public function monthlyTransactions($type = 'all', $year = null, $month = null){
        $year = $year ?? date('Y');
        $month = $month ?? date('F');

        $monthDate = "$month $year";

        //get first and last day of current month
        $first_day = date('Y-m-d H:i:s', strtotime('first day of ' . $monthDate));
        $last_day = date('Y-m-d H:i:s', strtotime('last day of' . $monthDate . ' 23:59:59'));

        $where_clause = [
            ['date_made', '>=', $first_day],
            ['date_made', '<=', $last_day],
        ];

        //if there is a specified type, add it
        if($type != 'all'){
            $type = $type == 'credit' ? TransactionType::getId('credit')  :  TransactionType::getId('debit');
            $where_clause[] = ['type_id', '=', $type];
        }

        //dd($this->transactions()->where($where_clause)->get()->all());
        return $this->transactions()->where($where_clause);
    }
}
