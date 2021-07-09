<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StarType extends Model
{
    public function zones() 
    {
        return $this->hasMany('App\Zone');
    }
}
