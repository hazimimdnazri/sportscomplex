<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public function r_membership(){
        return $this->belongsTo(LMembership::class, 'membership');
    }

    public function r_user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivityName($id){
        $activity = LActivity::find($id);
        return $activity->activity;
    }

    public function membershipBadge($id){
        switch ($id){
            case 1:
                return "<span class='label text-black' style='background-color:gold'>Gold</span>";
                break;
            
            case 2:
                return "<span class='label text-black' style='background-color:silver'>Silver</span>";
                break;
            
            case 3:
                return "<span class='label text-black' style='background-color:silver'>Silver</span>";
                break;
            
            case 4:
                return "<span class='label text-black' style='background-color:silver'>Silver</span>";
                break;
            
            case 5:
                return "<span class='label' style='background-color:brown'>Bronze</span>";
                break;
            
            case 6:
                return "<span class='label' style='background-color:brown'>Bronze</span>";
                break;
            
            case 7:
                return "<span class='label' style='background-color:brown'>Bronze</span>";
                break;
            
            case 8:
                return "<span class='label' style='background-color:green'>EduCity Student</span>";
                break;
            
            default:
                return "<span class='label bg-black'>Regular</span>";
                break;
        }
    }
}
