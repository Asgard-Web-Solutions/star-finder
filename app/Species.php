<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    public function characters()
    {
        return $this->hasMany('App\Character');
    }
}
