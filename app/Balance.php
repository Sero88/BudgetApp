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

    public function get_old_data(){
        $this->name = !empty(old('name')) ? old('name') : '';
        $this->description = !empty(old('description')) ? old('description') : '';
        $this->amount = !empty(old('amount')) ? old('amount') : '';
        $this->owner_id = !empty(old('owner_id')) ? old('ownder_id') : '';

    }
}
