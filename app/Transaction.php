<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function budget_categories(){
        return $this->belongsTo(BudgetCategory::class, 'budget_cat_id');
    }
}
