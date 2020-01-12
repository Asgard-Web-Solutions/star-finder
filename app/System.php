<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public function location()
    {
        return $this->hasOne('App\Location');
    }

    public function planets()
    {
        return $this->hasMany('App\Planet')->orderBy('distance_from_star');
    }
}
