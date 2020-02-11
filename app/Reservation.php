<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function r_asset(){
        return $this->belongsTo(LFacility::class, 'facility_id');
    }

    public function r_group(){
        return $this->belongsTo(LFacilityGroup::class, 'group_id');
    }

    public function r_activity(){
        return $this->belongsTo(LActivity::class, 'activity_id');
    }

    public function r_application(){
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function getEquiptments($id){
        $equiptments = Equiptment::where('reservation_id', $id)->get();
        return $equiptments;
    }
}
