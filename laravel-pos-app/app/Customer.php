<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function posrecord(){
        return $this->hasMany('App\Posrecord');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
