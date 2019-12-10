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
        $application->event = $request->event;
        $application->name = $request->name;
        $application->email = $request->email;
        $application->phone = $request->phone;
        $application->ic = $request->ic;
        $application->address = $request->address;
        $application->zipcode = $request->zipcode;
        $application->city = $request->city;
        $application->asset_id = $request->asset;
        $application->start_date = $request->start_date;
        $application->end_date = $request->end_date;
        $application->registered_by = Auth::user()->id;
        $application->remark = $request->remark;
        $application->attachment = $request->attachment;


        if($application->save()){
            return back();
        }
    }
}
