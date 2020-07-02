<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LMembership extends Model
{
    public function getActivityName($id){
        $activity = LActivity::find($id);
        return $activity->activity;
    }
}
