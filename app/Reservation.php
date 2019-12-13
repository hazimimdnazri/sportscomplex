<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function r_asset(){
        return $this->belongsTo(LAsset::class, 'asset_id');
    }

    public function r_activity(){
        return $this->belongsTo(LActivity::class, 'activity_id');
    }

    public function r_application(){
        return $this->belongsTo(Application::class, 'application_id');
    }
}
