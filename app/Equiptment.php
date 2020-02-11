<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equiptment extends Model
{
    public function r_equiptment(){
        return $this->belongsTo(LEquiptment::class, 'equiptment_id');
    }
}
