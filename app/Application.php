<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function a_applicant(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function a_asset(){
        return $this->belongsTo(LFacility::class, 'asset_id');
    }

    public function a_status(){
        return $this->belongsTo(LApplicationStatus::class, 'status');
    }

    public function r_payment(){
        return $this->hasOne(Payment::class, 'application_id', 'id');
    }

    public function r_transaction(){
        return $this->hasOne(Transaction::class, 'application_id', 'id');
    }

    public function getStatus($status){
        switch ($status) {
            case 1:
                return '<span class="label label-default">'.$this->a_status->status.'</span>';
                break;
            
            case 2:
                return '<span class="label label-info">'.$this->a_status->status.'</span>';
                break;
            
            case 3:
                return '<span class="label label-warning">'.$this->a_status->status.'</span>';
                break;
            
            case 4:
                return '<span class="label label-primary">'.$this->a_status->status.'</span>';
                break;
            
            case 5:
                return '<span class="label label-success">'.$this->a_status->status.'</span>';
                break;
            
            case 6:
                return '<span class="label label-danger">'.$this->a_status->status.'</span>';
                break;
    
            case 7:
                return '<span class="label bg-purple">'.$this->a_status->status.'</span>';
                break;
    
            case 8:
                return '<span class="label bg-navy">'.$this->a_status->status.'</span>';
                break;
    
            default:
                return '<span class="label label-warning">ERR</span>';
                break;
        }
    }
}
