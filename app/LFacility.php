<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LFacility extends Model
{
    public function r_group(){
        return $this->belongsTo(LFacilityGroup::class, 'group');
    }
}
