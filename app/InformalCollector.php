<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformalCollector extends Model
{
    //

    public function user() 
    { 
        return $this->morphOne('App\User', 'profile');
    }
    
}
