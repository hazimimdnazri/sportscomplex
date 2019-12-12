<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function r_asset(){
        return $this->belongsTo(LAsset::class, 'asset_id');
    }
}
