<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
