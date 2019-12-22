<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    public $timestamps = true;

    static function getId($name){
        return TransactionType::where('name', '=', $name)->get()->first()->id;
    }
}
