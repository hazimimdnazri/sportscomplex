<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LEquiptment extends Model
{
    public function r_facility(){
        return $this->belongsTo(LFacility::class, 'facility_id');
    }

    public function getDisableStatus($reservation_id, $equiptment_id){
        $equiptment = Equiptment::where('reservation_id', $reservation_id)->where('equiptment_id', $equiptment_id)->first();
        if($equiptment){
            return 'disabled';
        }
    }
}
