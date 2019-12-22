<?php


namespace App;

use App\TransactionType;

trait Monthly
{
    public function monthlyTransactions($type = 'all'){

        //get first and last day of current month
        $first_day = date('Y-m-d H:i:s', strtotime('first day of ' . date('F Y')));
        $last_day = date('Y-m-d H:i:s', strtotime('last day of' . date('F Y') . '23:59:59'));

        //dd(strtotime('first day of ' . date('F Y')));

        $where_clause = [
            ['date_made', '>=', $first_day],
            ['date_made', '<=', $last_day],
        ];


        //if there is a specified type, add it
        if($type != 'all'){
            $trans_type = new TransactionType();
            $type = $type == 'credit' ? TransactionType::getId('credit')  :  TransactionType::getId('debit');
            $where_clause[] = ['type_id', '=', $type];
        }

        //dd($this->transactions()->where($where_clause)->get()->all());
        return $this->transactions()->where($where_clause);

    }


}
