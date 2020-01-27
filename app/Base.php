<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function facilities()
    {
        return $this->hasMany('App\Facility');
    }

    public function planet()
    {
        return $this->belongsTo('App\Planet');
    }
}
