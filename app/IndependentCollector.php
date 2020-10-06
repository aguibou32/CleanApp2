<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndependentCollector extends Model
{
    public function user() 
    { 
        return $this->morphOne('App\User', 'profile');
    }

    public function vehicle(){
        return $this->hasOne('App\Vehicule');
    }

    public function collections(){
        return $this->hasMany('App\Collection');
    }

}
