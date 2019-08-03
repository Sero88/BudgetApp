<?php


namespace App;


trait Monthly
{
    public function monthly_transactions($type = 'all'){

        //get first and last day of current month
        $first_day = date('Y-m-d H:i:s', strtotime('first day of ' . date('F Y')));
        $last_day = date('Y-m-d H:i:s', strtotime('last day of' . date('F Y') . '23:59:59'));

        $where_clause = [
            ['date_made', '>=', $first_day],
            ['date_made', '<=', $last_day],
        ];


        //if there is a specified type, add it
        if($type != 'all'){
            $type = $type == 'credit' ? 1 : 2;
            $where_clause[] = ['type_id', '=', $type];
        }

        //dd($this->transactions()->where($where_clause)->get()->all());
        return $this->transactions()->where($where_clause);

    }

}