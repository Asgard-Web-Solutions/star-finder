<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function characters()
    {
        return $this->belongsToMany('App\Character');
    }
}
