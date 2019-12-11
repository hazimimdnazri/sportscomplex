<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function a_applicant(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function a_asset(){
        return $this->belongsTo(LAsset::class, 'asset_id');
    }

    public function a_status(){
        return $this->belongsTo(LApplicationStatus::class, 'status');
    }
}
