<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetCategory extends Model
{
    use Monthly;
    use SoftDeletes;
    protected $guarded = [];
    public $timestamps = false;

    public function transactions(){
        return $this->hasMany(Transaction::class, 'budget_cat_id');
    }

    public function recurringTransactions(){
        return $this->hasMany(RecurringTransaction::class, 'budget_cat_id');
    }

    public function balance(){
        return $this->belongsTo('\App\Balance', 'balance_id');
    }

    public function remove_transactions(){
        foreach( $this->transactions as $transaction){
            $transaction->delete();
        }

        foreach($this->recurringTransactions as $recurringTrans){
            $recurringTrans->delete();
        }

    }

    public function getExpensePercentage(){
        return round( ( $this->monthlyTransactions('credit')->sum('amount') / $this->budget() ) * 100, 2) . '%';
    }

    public function getActual($year, $month){
        //the difference between $this->transactions and $this->transactions() is that w/o parentheses a collection is returned
        //with parentheses a hasMany object is returned thus we can run a query such as where
        //collections also have their where method, but can't use 'like %'
        $actuals = $this->transactions()->where([
            ['budget_cat_id', '=', $this->id],
            ['date_made', 'like', $year. '-'.$month.'%'],
            ['type_id', TransactionType::getId('credit')]
        ])->get()->sum('amount');

        return $actuals;

    }

    public function subCategories(){
        return $this->hasMany(SubBudgetCategory::class, 'budget_category_id');
    }

    public function budget(){
        return $this->subCategories->sum('budget');
    }

}
