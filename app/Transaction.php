<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function budget_categories(){
        return $this->belongsTo(BudgetCategory::class, 'budget_cat_id');
    }

    public function transaction_type(){
        return $this->belongsTo(TransactionType::class, 'type_id');
    }

    public function get_old_data(){
        $this->amount = !empty(old('amount')) ? old('amount') : $this->amount;
        $this->type_id = !empty(old('type_id')) ? old('type_id') : $this->type_id;
        $this->budget_cat_id = !empty(old('budget_cat_id')) ? old('budget_cat_id') : $this->budget_cat_id;
        $this->description = !empty(old('description')) ? old('description') : '';
    }
}
