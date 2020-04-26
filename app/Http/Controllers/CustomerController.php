<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LVenue;
use App\Application;
use App\Equiptment;
use App\User;
use App\Facility;
use App\Activity;
use App\LActivity;
use App\LCustomerType;
use App\Payment;
use Auth;

class CustomerController extends Controller
{
    public function dashboard(){
        return view('customer.dashboard');
    }

    public function applications(){
        $user_id = Auth::user()->id;
        $applications = Application::all()->where('user_id', $user_id)->where('flag', 1);
        return view('customer.application.index', compact('applications'));
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
        return view('customer.application.details', compact('application', 'equiptments'));
    }

    public function itemType(Request $request){
        $id = $request->id;
        $application = Application::find($id);
        $user = User::find($request->user);
        $date = Application::find($id)->date;
        $venues = LVenue::all();
        $equiptments = Equiptment::where('application_id', $request->id)->get();
        $list_activity = LActivity::all();
        $application->type = $request->type;
        if($application->save()){
            if($request->type == 1){
                $facilities = Facility::where('application_id', $request->id)->get();
                return view('customer.application.partials.facility', compact('facilities', 'venues', 'id', 'user', 'date', 'equiptments'));
            } else if($request->type == 2) {
                $activities = Activity::where('application_id', $request->id)->get();
                return view('customer.application.partials.activity', compact('list_activity', 'activities', 'id', 'user', 'date', 'equiptments'));
            } else {
                return NULL;
            }
        }
    }
}
