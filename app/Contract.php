<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function base()
    {
        return $this->belongsTo('App\Base');
    }

    public function getNextAtAttribute($time)
    {
        $now = Carbon::now();
        $diff = $now->diffInMinutes($time);

        return $diff . "m";
    }

    public function getExpiresAtAttribute($time)
    {
        $now = Carbon::now();
        $diff = $now->diffInHours($time);

        return $diff . "h";
    }

}
