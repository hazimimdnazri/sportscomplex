<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LAsset;
use App\User;
use App\Membership;
use App\Member;
use App\LAssetType;

class SettingsController extends Controller
{
    public function categories(){
        $assets = LAssetType::all();
        return view('settings.categories', compact('assets'));
    }

    public function submitCategory(Request $request){
        $assets = new LAsset;
        $assets->asset = $request->asset;

        if($assets->save()){
            return back();
        }
    }
    
    public function assets(){
        $assets = LAsset::all();
        return view('settings.assets', compact('assets'));
    }

    public function submitAsset(){

    }    

    public function users(){
        $users = User::all();
        return view('settings.users', compact('users'));
    }

    public function profile(){
        return view('settings.profile');
    }

    public function members(){
        $members = Member::all();
        return view('settings.members', compact('members'));
    }

    public function membership(){
        $memberships = Membership::all();
        return view('settings.membership', compact('memberships'));
    }
}
