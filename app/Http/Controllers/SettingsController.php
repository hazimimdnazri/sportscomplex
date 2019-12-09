<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LAsset;

class SettingsController extends Controller
{
    public function assets(){
        $assets = LAsset::all();
        return view('settings.assets', compact('assets'));
    }

    public function submitAsset(Request $request){
        $assets = new LAsset;
        $assets->asset = $request->asset;

        if($assets->save()){
            return back();
        }
    }

    public function users(){
        return view('settings.users');
    }

    public function profile(){
        return view('settings.profile');
    }
}
