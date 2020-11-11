<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immobile extends Model
{
    protected $fillable = ['active', 'solded'];

    protected function contract() 
    {
        return $this->hasOne('\App\Contract', 'idImmobile');
    }
}
