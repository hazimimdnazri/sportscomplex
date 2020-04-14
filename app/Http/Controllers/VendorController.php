<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LVenue;
use App\Application;
use App\Equiptment;
use App\User;
use App\Reservation;
use App\LActivity;
use App\LCustomerType;
use Auth;

class VendorController extends Controller
{
    public function dashboard(){
        return view('vendor.dashboard');
    }

    public function calendar(){
        $venues = LVenue::all();
        return view('admin.calendar', compact('reservations', 'venues'));
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

    public function quotationView($id){
        $application = Application::find($id);
        $reservations = Reservation::where('application_id', $id)->get();
        $customer = User::find(Auth::user()->id);
        $equiptments = Equiptment::where('application_id', $id)->get();
        return view('vendor.application.quotation', compact('application', 'customer', 'reservations', 'equiptments'));
    }

    public function submitReservation(Request $request){
        $application = Application::find($request->id);
        $application->status = 2;
        if($application->save()){
            return "success";
        }
    }

    public function acceptReservation(Request $request){
        $application = Application::find($request->id);
        $application->status = 4;
        if($application->save()){
            return "success";
        }
    }

    public function itemType(Request $request){
        $id = $request->id;
        $application = Application::find($id);
        $user = User::find($request->user);
        $date = Application::find($id)->date;
        $reservations = Reservation::where('application_id', $request->id)->where('type', $request->type)->get();
        $venues = LVenue::all();
        $equiptments = Equiptment::where('application_id', $request->id)->get();
        $activities = LActivity::all();
        $application->type = $request->type;
        if($application->save()){
            if($request->type == 1){
                return view('vendor.application.partials.facility', compact('reservations', 'venues', 'id', 'user', 'date', 'equiptments'));
            } else if($request->type == 2) {
                return view('vendor.application.partials.activity', compact('reservations', 'activities', 'id', 'user', 'date', 'equiptments'));
            } else {
                return NULL;
            }
        }
    }

    public function modalAdminApproval(Request $request){
        $application = Application::find($request->id);
        if(isset($request->action) == 'delete'){
            $application->flag = 0;
            if($application->save()){
                return 'success';
            }
        }
        $equiptments = Equiptment::where('application_id', $application->id)->get();
        $types = LCustomerType::all();
        if($application->type == 1){
            $reservations = Reservation::where('application_id', $application->id)->where('type', 1)->get();
            return view('vendor.application.partials.modal-facilityApproval', compact('application', 'types', 'reservations', 'equiptments'));
        } else {
            $reservations = Reservation::where('application_id', $application->id)->where('type', 2)->get();
            return view('admin.applications.partials.modal-activityApproval', compact('application', 'types', 'reservations', 'equiptments'));
        }
    }
}
