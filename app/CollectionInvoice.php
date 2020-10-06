<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionInvoice extends Model
{
    //

    public function buy_back_center(){
        return $this->belongsTo('App\BuyBackCenter');
    }

}
