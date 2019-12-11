<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LAsset;
use App\User;
use App\Membership;
use App\Member;
use App\LAssetType;
use App\LActivity;

class SettingsController extends Controller
{
    public function categories(){
        $assets = LAssetType::all();
        return view('settings.categories', compact('assets'));
    }

    public function submitCategory(Request $request){
        $assets = new LAssetType;
        $assets->type = $request->asset;

        if($assets->save()){
            return back();
        }
    }
    
    public function assets(){
        $assets = LAsset::all();
        $types = LAssetType::all();
        return view('settings.assets', compact('assets', 'types'));
    }

    public function submitAsset(Request $request){
        $asset = new LAsset;
        $asset->asset = $request->asset;
        $asset->type = $request->category;
        $asset->price = $request->price;
        $asset->min_hour = $request->min_hour;
        $asset->remark = $request->remark;

        if($asset->save()){
            return back();
        }
    }   
    
    public function activities(){
        $activities = LActivity::all();
        return view('settings.activities', compact('activities'));
    }

    public function submitActivity(Request $request){
        $activity = new LActivity;
        $activity->activity = $request->activity;
        $activity->public = $request->public;
        $activity->students = $request->students;
        $activity->underage = $request->underage;
        $activity->deposit = $request->deposit;
        $activity->remark = $request->remark;

        if($activity->save()){
            return back();
        }
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
