<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickItUpCenter extends Model
{
    //

    public function user() 
    { 
        return $this->morphOne('App\User', 'profile');
    }
}
