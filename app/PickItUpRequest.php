<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickItUpRequest extends Model
{
    //
    public function request() 
    { 
        return $this->morphOne('App\Request', 'request_profile');
    }

}
