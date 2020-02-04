<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    public function r_membership(){
        return $this->belongsTo(LMembership::class, 'membership');
    }
}
