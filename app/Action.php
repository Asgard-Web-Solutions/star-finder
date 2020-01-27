<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use SoftDeletes;

    protected $dates = ['finish_time'];

    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function getFinishesAtAttribute($time)
    {
        $now = Carbon::now();
        $diff = $now->diffInMinutes($time);

        return $diff . "m";
    }
}
