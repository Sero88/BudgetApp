<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function budget_categories(){
        return $this->hasMany(BudgetCategory::class);
    }
}
