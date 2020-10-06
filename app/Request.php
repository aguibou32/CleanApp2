<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //
    protected $with = ['request_profile'];

    public function resident(){
        return $this->belongsTo('App\Resident');
    }
    
    public function request_profile()
    {
      return $this->morphTo();
    }

}
