<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function m_membership(){
        return $this->belongsTo(Membership::class, 'membership');
    }
}
