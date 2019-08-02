<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function budget_category(){
        return $this->belongsTo(BudgetCategory::class, 'budget_cat_id');
    }

    public function transaction_type(){
        return $this->belongsTo(TransactionType::class, 'type_id');
    }

    /*public function balance(){
        return $this->hasOneThrough('\App\Balance', '\App\BudgetCategory', 'balance_id');

    }*/


}
