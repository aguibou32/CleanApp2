<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingInformation extends Model
{
    //

    public function user(){
        return $this->belongsTo('App\User');
    }

}
