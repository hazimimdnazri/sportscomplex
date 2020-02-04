<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LFacility extends Model
{
    public function r_type(){
        return $this->belongsTo(LFacilityType::class, 'type');
    }
}
