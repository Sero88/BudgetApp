<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use Monthly;

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

    public function balanceUpdate($transaction){
        //get the transaction amount
        $transAmount = $transaction->transaction_type->name == 'credit' ? $transaction->amount * -1 : $transaction->amount;

        //update balance amount
        $this->update(['amount' => $this->amount + $transAmount ]);
    }

}
