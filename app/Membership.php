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

    public function membershipBadge($id){
        switch ($id){
            case 1:
                return "<span class='label text-black' style='background-color:gold'>Gold</span>";
                break;
            
            case 2:
                return "<span class='label text-black' style='background-color:silver'>Silver</span>";
                break;
            
            case 3:
                return "<span class='label' style='background-color:brown'>Bronze</span>";
                break;
            
            default:
                return "<span class='label bg-black'>Regular</span>";
                break;
        }
    }
}
