<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LEquiptment extends Model
{
    public function r_facility(){
        return $this->belongsTo(LFacility::class, 'facility_id');
    }

    public function getDisableStatus($equiptment_id){
        $equiptment = LEquiptment::find($equiptment_id);
        if($equiptment->status == 2){
            return 'disabled';
        } else {
            $equiptment = Equiptment::where('equiptment_id', $equiptment_id)->where('status', '<', 3)->first();
            if($equiptment){
                return 'disabled';
            }
        }
    }
}
