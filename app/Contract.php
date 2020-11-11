<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    
    protected function immobile() 
    {

        return $this->belongsTo('App\Immobile');

    }

}
