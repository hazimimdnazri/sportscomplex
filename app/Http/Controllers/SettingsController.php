<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\LMembership;
use App\Customer;
use App\LActivity;

class SettingsController extends Controller
{

    public function profile(){
        return view('settings.profile');
    }

    public function membership(){
        $memberships = LMembership::all();
        return view('settings.membership', compact('memberships'));
    }

    public function submitMembership(Request $request) {

        $membership = new LMembership;
        $membership->membership = $request->membership;
        $membership->discount = $request->discount;
        $membership->monthly = $request->monthly;
        $membership->anually = $request->anually;
        
        if($membership->save()){
            return back();
        }
    }
}
