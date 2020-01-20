<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $dates = ['mined_at'];

    public function base()
    {
        return $this->belongsTo('App\Base');
    }

    public function facility_type()
    {
        return $this->belongsTo('App\FacilityType');
    }
}
