<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LAsset;
use App\Application;
use Auth;
use App\Customer;
use App\Reservation;

class ApplicationController extends Controller
{
    public function index(){
        $assets = LAsset::all();
        $applications = Application::all();
        return view('application', compact('assets', 'applications'));
    }

    public function details($id){
        $application = $applications = Application::find($id);
        $reservations = Reservation::where('application_id', $id)->get();
        return view('applications.details', compact('application', 'reservations'));
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

    public function assetModal(){
        $assets = LAsset::all();
        return view('shared.asset_modal', compact('assets'));
    }

    public function detailsModal(Request $request){
        $id = $request->id;
        $assets = LAsset::all();
        return view('shared.details_modal', compact('assets', 'id'));
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
            // $application->event = $request->event;
            // $application->asset_id = $request->asset;
            $application->registered_by = Auth::user()->id;
            // $application->remark = $request->remark;
            // $application->attachment = $request->attachment;
            // $application->start_date = date('Y-m-d H:i:s', strtotime($request->date." ".$request->time));
            // $application->end_date = date('Y-m-d H:i:s', strtotime($request->date." ".$request->time) + 60 * 60 * $request->duration);

            if($application->save()){
                return redirect("application/$application->id");
            }
        }
    }

    public function payment($id){
        $application = Application::find($id);
        $customer = Customer::find($application->customer_id);
        $duration = (strtotime($application->end_date) -  strtotime($application->start_date)) / (60 * 60);
        $asset = LAsset::find($application->asset_id);
        return view('applications.payment', compact('customer', 'application', 'duration', 'asset'));
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
}
