<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public function location()
    {
        return $this->hasOne('App\Location');
    }
}
