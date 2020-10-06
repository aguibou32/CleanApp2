<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function collector(){
        return $this->belongsTo('App\IndependentCollector');
    }

    public function collection_feedbacks(){
        return $this->hasMany('App\CollectionFeedback');
    }
}
