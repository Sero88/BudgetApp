<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
