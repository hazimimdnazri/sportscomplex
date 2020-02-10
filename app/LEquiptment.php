<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LEquiptment extends Model
{
    public function r_facility(){
        return $this->belongsTo(LFacility::class, 'facility_id');
    }
}
