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

    public function getStatus($status){
        switch ($status) {
            case 1:
                return '<span class="label label-default">Draft</span>';
                break;
            
            case 2:
                return '<span class="label label-info">Processing</span>';
                break;
            
            case 3:
                return '<span class="label label-default">Approved by Vendor</span>';
                break;
            
            case 4:
                return '<span class="label label-primary">Approved by Admin</span>';
                break;
            
            case 5:
                return '<span class="label label-success">Paid</span>';
                break;
            
            case 6:
                return '<span class="label label-danger">Rejected</span>';
                break;
    
            default:
                return '<span class="label label-warning">ERR</span>';
                break;
        }
    }
}
