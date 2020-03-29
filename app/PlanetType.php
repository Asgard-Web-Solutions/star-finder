<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanetType extends Model
{
    public function zones()
    {
        return $this->belongsToMany('App\Zone')->withPivot('probability');
    }
}
