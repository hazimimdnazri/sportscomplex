<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LVenue;
use App\Application;
use App\Equiptment;
use Auth;

class VendorController extends Controller
{
    public function dashboard(){
        return view('vendor.dashboard');
    }

    public function calendar(){
        $venues = LVenue::all();
        return view('calendar', compact('reservations', 'venues'));
    }

    public function application(){
        $user_id = Auth::user()->id;
        $applications = Application::all()->where('user_id', $user_id)->where('flag', 1);
        return view('vendor.application.index', compact('applications'));
    }

    public function applicationNew(){
        $application = new Application;
        $application->user_id = Auth::user()->id;
        $application->date = date('Y-m-d');
        $application->registered_by = Auth::user()->id;
        if($application->save()){
            $response = [
                'code' => 200,
                'status' => 'success',
                'data' => $application->id
            ];

            return $response;
        }
    }

    public function applicationDetails($id){
        $application = Application::find($id);
        $equiptments = Equiptment::where('application_id', $id)->get();
        return view('vendor.application.details', compact('application', 'equiptments'));
    }
}
