<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    use Monthly;
    protected $guarded = [];

    public function transactions(){
        return $this->hasMany(Transaction::class, 'budget_cat_id');
    }

    public function balance(){
        return $this->belongsTo('\App\Balance', 'balance_id');
    }

    public function remove_transactions(){
        foreach( $this->transactions()->get()->all() as $transaction){
            $transaction->delete();
        }

    }
    public function getExpensePercentage(){
        return round( ( $this->monthlyTransactions()->sum('amount') / $this->budget ) * 100, 2) . '%';
    }


}
