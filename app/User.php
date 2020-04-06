<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function u_status(){
        return $this->belongsTo(LUserStatus::class, 'status');
    }

    public function r_role(){
        return $this->belongsTo(LRole::class, 'role');
    }

    public function r_details(){
        return $this->hasOne(CustomerDetail::class, 'user_id', 'id');
    }

    public function r_student(){
        return $this->hasOne(StudentDetail::class, 'user_id', 'id');
    }

    public function r_staff(){
        return $this->hasOne(StaffDetail::class, 'user_id', 'id');
    }

    public function r_vendor(){
        return $this->hasOne(VendorDetail::class, 'user_id', 'id');
    }

    public function getMembershipID($id){
        $membership = Membership::where('user_id', $id)->orderBy('cycle_end', 'DESC')->first();
        if($membership){
            return $membership->membership;
        } else {
            return NULL;
        }
    }

    public function getMembershipCycle($id){
        $membership = Membership::where('user_id', $id)->orderBy('cycle_end', 'DESC')->first();
        if($membership){
            return $membership->cycle;
        } else {
            return NULL;
        }
    }

    public function getMembership($id){
        $membership = Membership::where('user_id', $id)->orderBy('cycle_end', 'DESC')->first();
        if($membership){
            switch ($membership->membership){
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
        } else {
            return "<span class='label bg-black'>Regular</span>";
        }
    }

    public function getMembershipDuration($id){
        $membership = Membership::where('user_id', $id)->orderBy('cycle_end', 'DESC')->first();
        if($membership){
            return date("d/m/Y", strtotime($membership->cycle_end));
        } else {
            return "-";
        }
    }
}
