<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function star_type()
    {
        return $this->belongsTo('App\StarType');
    }

    public function planet_types()
    {
        return $this->belongsToMany('App\PlanetType')->withPivot('probability');
    }
}
