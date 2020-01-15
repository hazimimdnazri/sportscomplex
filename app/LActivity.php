<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LActivity extends Model
{
    //public $timestamps = false;

    public function user(){
    	return $this->hasOne(User::class,'id','created_by');
    }
}
