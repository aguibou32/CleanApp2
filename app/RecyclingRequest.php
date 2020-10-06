<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecyclingRequest extends Model
{
    //
    protected $guarded = [];

    public function request() 
    { 
       return $this->morphOne('App\Request', 'request_profile');
    }
}
