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

    public function bases()
    {
        return $this->hasMany('App\Base');
    }

    public function actions()
    {
        return $this->hasMany('App\Action');
    }

    public function plans()
    {
        return $this->belongsToMany('App\Plan');
    }
}
