<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use Monthly;
    use Daily;


    protected $guarded = [];
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function budgetCategories(){
        return $this->hasMany(BudgetCategory::class);
    }

    public function transactions(){
        return $this->hasManyThrough(Transaction::class, BudgetCategory::class, 'balance_id', 'budget_cat_id');
    }

    public function balanceUpdate($transaction, $action = 'create'){
        //get the transaction amount
        $transAmount = $transaction->transactionType->name == 'credit' ? $transaction->amount * -1 : $transaction->amount;

        if($action == 'delete'){
            $transAmount *= -1; //opposite since we are reverting transaction
        }

        //update balance amount
        $this->update(['amount' => $this->amount + $transAmount ]);
    }

    public function getExpensePercentage(){
        return round(( $this->monthlyTransactions('credit')->sum('amount') / $this->budgetCategories->sum('budget') ) * 100, 2) . '%';
    }
}
