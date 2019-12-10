<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Member as MemberResource;
use App\Member;

class ApiController extends Controller
{
    public function members(){
        $members = Member::all();
        return MemberResource::collection($members);
    }

    public function member($id){
        $members = Member::find($id);
        return new MemberResource($members);
    }
}
