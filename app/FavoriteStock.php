<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteStock extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
