<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportDumping extends Model
{
    //
    protected $guarded = [];
    
    public function resident(){
        return $this->belongsTo('App\Resident');
    }
}
