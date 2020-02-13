<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LFacility extends Model
{
    public function r_venue(){
        return $this->belongsTo(LVenue::class, 'venue');
    }
}
