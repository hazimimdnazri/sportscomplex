<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveActivity extends Model
{
    public function r_venue(){
        return $this->belongsTo(LVenue::class, 'venue');
    }

    public function r_activity(){
        return $this->belongsTo(LActivity::class, 'activity_id');
    }
}
