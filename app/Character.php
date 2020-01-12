<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function species()
    {
        return $this->belongsTo('App\Species');
    }

    public function planet()
    {
        return $this->belongsTo('App\Planet');
    }
}
