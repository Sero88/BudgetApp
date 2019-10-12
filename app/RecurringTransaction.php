<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecurringTransaction extends Model
{
    protected $guarded = [];

    public function transactionType(){
        return $this->belongsTo(TransactionType::class, 'transaction_type');
    }

    public function transactionInterval(){
        return $this->belongsTo(TransactionInterval::class, 'interval_id');
    }

    public function budgetCategory(){
        return $this->belongsTo(BudgetCategory::class, 'budget_cat_id');
    }
}
