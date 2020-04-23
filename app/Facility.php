<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function r_sport(){
        return $this->belongsTo(LSport::class, 'sport_id');
    }

    public function r_group(){
        return $this->belongsTo(LFacilityGroup::class, 'group_id');
    }

    public function r_application(){
        return $this->belongsTo(Application::class, 'application_id');
    }
}
