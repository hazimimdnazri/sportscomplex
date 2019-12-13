<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LAsset;
use App\Application;
use Auth;
use App\Customer;
use App\Reservation;
use App\LActivity;

class ApplicationController extends Controller
{
    public function index(){
        $assets = LAsset::all();
        $applications = Application::all();
        return view('application', compact('assets', 'applications'));
    }

    public function details($id){
        $application = Application::find($id);
        return view('applications.details', compact('application'));
    }

    public function submitDetails(Request $request, $id){
        $reservation = new Reservation;
        $reservation->application_id = $id;
        $reservation->asset_id = $request->asset;
        $reservation->type = $request->type;
        $reservation->activity_id = $request->activity;
        $reservation->duration = $request->duration;
        if($reservation->save()){
            return back();
        }
    }

    public function ajaxSetDate(Request $request){
        $application = Application::find($request->id);
        $application->date = date('Y-m-d',strtotime($request->date));
        if($application->save()){
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function itemType(Request $request){
        $id = $request->id;
        if($request->type == 1){
            $assets = LAsset::all();
            $reservations = Reservation::where('application_id', $request->id)->where('type',1)->get();
            return view('shared.asset', compact('reservations', 'assets', 'id'));
        } else if($request->type == 2) {
            $activities = LActivity::all();
            $reservations = Reservation::where('application_id', $request->id)->where('type',2)->get();
            return view('shared.activity', compact('reservations', 'activities', 'id'));
        } else {
            return NULL;
        }
    }

    public function activityType(){
        
        return view('shared.asset', compact('reservations'));
    }

    public function activityModal(){
        return view('shared.activity_modal');
    }

    public function submitApplication(Request $request){
        $cust_id = $request->post_id;
        
        if($cust_id == ''){
            $date = str_split(substr($request->ic, 0, 6), 2);
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->dob = date('Y-m-d', strtotime("$date[0]-$date[1]-$date[2]"));
            $customer->phone = $request->phone;
            $customer->ic = $request->ic;
            $customer->address = $request->address;
            $customer->zipcode = $request->zipcode;
            $customer->city = $request->city;
            $customer->state = $request->state;
        } else {
            $customer = Customer::find($cust_id);
        }

        if($customer->save() || $cust_id != ''){
            if($cust_id == ''){
                $cust_id = $customer->id;
            }
            $application = new Application;
            $application->customer_id = $cust_id;
            $application->registered_by = Auth::user()->id;
            $application->date = date('Y-m-d');

            if($application->save()){
                return redirect("application/$application->id");
            }
        }
    }

    public function payment($id){
        $application = Application::find($id);
        $application->status = 2;
        if($application->save()){
            $reservations = Reservation::where('application_id', $id)->get();
            $reservation = Reservation::where('application_id', $id)->first();
            $customer = Customer::find($application->customer_id);
            if($reservation->type == 1){
                return view('applications.payment', compact('customer', 'application', 'reservations'));
            } else {
                return view('applications.activity_payment', compact('customer', 'application', 'reservations'));
            }
        }
    }

    public function ajaxSubmitPayment(Request $request){
        $application = Application::find($request->id);
        $application->status = 3;
        if($application->save()){
            return "success";
        } else {
            return "fail";
        }
    }

    public function confirmReservation(Request $request){
        $application = Application::find($request->id);
        $application->event = $request->event_name;
        if($application->save()){
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function submitFacility(Request $request, $id){
        $reservation = new Reservation;
        $reservation->application_id = $id;
        $reservation->asset_id = $request->asset;
        $reservation->type = 1;
        $reservation->duration = $request->duration;
        $reservation->start_date = date('Y-m-d 00:00:00', strtotime(Application::find($id)->date));
        $reservation->end_date = date('Y-m-d H:i:s', strtotime($reservation->start_date) + (60*60*$reservation->duration));

        if($reservation->save()){
            return back();
        }
    }

    public function submitActivity(Request $request, $id){

        for($i = 0; $i < $request->quantity; $i++){
            $reservation = new Reservation;
            $reservation->application_id = $id;
            $reservation->activity_id = $request->activity;
            $reservation->type = 2;
            $reservation->price_type = $request->price;
            $reservation->duration = 0;
            $reservation->start_date = date('Y-m-d 00:00:00', strtotime(Application::find($id)->date));
            $reservation->end_date = date('Y-m-d 00:00:00', strtotime(Application::find($id)->date));

            if($reservation->save()){
            } else {
                echo "error!";
                die();
            }
        }
        return back();
    }
}
