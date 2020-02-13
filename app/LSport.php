<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LSport extends Model
{
    public function getVenueName($id){
        $facility = LFacility::find($id);
        return $facility->r_venue->venue;
    }

    public function getFacilityName($id){
        $facility = LFacility::find($id);
        return $facility->facility;
    }
}
