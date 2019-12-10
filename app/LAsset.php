<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LAsset extends Model
{
    public $timestamps = false;

    public function a_type(){
        return $this->belongsTo(LAssetType::class, 'type');
    }
}
