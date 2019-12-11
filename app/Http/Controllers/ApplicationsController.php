<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LAsset;
use App\Application;
use Auth;
use App\Customer;

class ApplicationsController extends Controller
{
    public function index(){
        $assets = LAsset::all();
        $applications = Application::all();
        return view('application', compact('assets', 'applications'));
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
        }

        if($customer->save() || $cust_id != ''){
            if($cust_id == ''){
                $cust_id = $customer->id;
            }
            $application = new Application;
            $application->customer_id = $cust_id;
            $application->event = $request->event;
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
}
