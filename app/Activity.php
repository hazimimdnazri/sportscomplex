<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function r_application(){
        return $this->belongsTo(Application::class, 'application_id');
    }
    
    public function r_activity(){
        return $this->belongsTo(LActivity::class, 'activity_id');
    }

    public function getCount($id, $activity){
        return $this->where('application_id', $id)->where('activity_id', $activity)->count();
    }

    public function getPriceType($type){
        switch ($type) {
            case 1:
                return 'Public';
                break;

            case 2:
                return 'Student';
                break;
            
            case 3:
                return 'Underage';
                break;
            
            case 4:
                return 'Special';
                break;
            
            default:
                return 'ERR';
                break;
        }
    }
}
