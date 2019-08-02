<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $guarded = [];
    //public $timestamps = true;

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function budget_categories(){
        return $this->hasMany(BudgetCategory::class);
    }

    public function transactions(){
        return $this->hasManyThrough(Transaction::class, BudgetCategory::class, 'balance_id', 'budget_cat_id');
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
