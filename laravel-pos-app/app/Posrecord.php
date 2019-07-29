<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posrecord extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User');
    }
}
