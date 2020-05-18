<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LActivity extends Model
{

    public function r_venue(){
        return $this->belongsTo(LVenue::class, 'venue');
    }

    public $timestamps = false;
}
