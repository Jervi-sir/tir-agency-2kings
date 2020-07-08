<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class); // select * from user where user_id = 1
    }
}
