<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveFacility extends Model
{
    public function r_venue(){
        return $this->belongsTo(LVenue::class, 'venue');
    }

    public function r_sport(){
        return $this->belongsTo(LSport::class, 'sport_id');
    }

    public function r_facility(){
        return $this->belongsTo(LSport::class, 'facility');
    }
}
