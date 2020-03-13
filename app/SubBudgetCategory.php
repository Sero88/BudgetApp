<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubBudgetCategory extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    use Monthly;
    use SoftDeletes;

    public function transactions(){
        return $this->hasMany(Transaction::class, 'sub_budget_category_id');
    }

    public function recurringTransactions(){
        return $this->hasMany(RecurringTransaction::class, 'sub_budget_category_id');
    }

    public function budgetCategory(){
        return $this->belongsTo(BudgetCategory::class, 'budget_category_id');
    }

    public function getExpensePercentage(){
        return round( ( $this->monthlyTransactions('credit')->sum('amount') / $this->budget ) * 100, 2) . '%';
    }
}
