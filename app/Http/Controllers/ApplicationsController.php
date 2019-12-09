<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LAsset;
use App\Application;
use Auth;

class ApplicationsController extends Controller
{
    public function index(){
        $assets = LAsset::all();
        $applications = Application::all();
        return view('application', compact('assets', 'applications'));
    }

    public function submitApplication(Request $request){
        $application = new Application;
        $application->user_id = Auth::user()->id;
        $application->asset_id = $request->asset;
        $application->start_date = $request->start_date;
        $application->end_date = $request->end_date;

        if($application->save()){
            return back();
        }
    }
}
