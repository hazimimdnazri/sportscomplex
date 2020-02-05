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
}
