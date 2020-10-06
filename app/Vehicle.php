<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    public function collector_driver(){
        return $this->belongsTo('App\IndependentCollector');
    }

}
