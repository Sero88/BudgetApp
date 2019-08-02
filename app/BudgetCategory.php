<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    protected $guarded = [];

    public function transactions(){
        return $this->hasMany(Transaction::class, 'budget_cat_id');
    }

    public function balance(){
        return $this->belongsTo('\App\Balance', 'balance_id');
    }

    public function monthlyTransactions(){
        //get first and last day of current month
        $first_day = date('Y-m-d H:i:s', strtotime('first day of '. date('F Y')));
        $last_day = date('Y-m-d H:i:s', strtotime( 'last day of' . date('F Y') . '23:59:59'));

        return $this->transactions()->where([
            ['date_made', '>=', $first_day],
            ['date_made', '<=', $last_day]
        ]);
    }

}
