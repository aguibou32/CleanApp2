<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyBackCenter extends Model
{
    protected $guarded = [];
    
    public function user() 
    { 
        return $this->morphOne('App\User', 'profile');
    }

    public function collection_invoices(){
        return $this->hasMany('App\CollectionInvoice');
    }
    
}
