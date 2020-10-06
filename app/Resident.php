<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    //
    public function user() 
    { 
        return $this->morphOne('App\User', 'profile');
    }

    public function request_collections(){
        return $this->hasMany('App\Request');
    }

    public function dumping_reports(){
        return $this->hasMany('App\ReportDumping');
    }
    

}
