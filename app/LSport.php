<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LSport extends Model
{
    public function r_venue(){
        return $this->belongsTo(LVenue::class, 'venue');
    }

    public function getFacilityName($id){
        $facility = LFacility::find($id);
        return $facility->facility;
    }
}
