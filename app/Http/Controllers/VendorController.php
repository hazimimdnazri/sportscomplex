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
use App\Quotation;
use App\Payment;
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
        $venues = LVenue::all();
        $equiptments = Equiptment::where('application_id', $request->id)->get();
        $list_activity = LActivity::all();
        $application->type = $request->type;
        if($application->save()){
            if($request->type == 1){
                $facilities = Facility::where('application_id', $request->id)->get();
                return view('vendor.application.partials.facility', compact('facilities', 'venues', 'id', 'user', 'date', 'equiptments'));
            } else if($request->type == 2) {
                $activities = Activity::where('application_id', $request->id)->get();
                return view('vendor.application.partials.activity', compact('list_activity', 'activities', 'id', 'user', 'date', 'equiptments'));
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
            $facilities = Facility::where('application_id', $application->id)->get();
            return view('vendor.application.partials.modal-facility', compact('application', 'types', 'facilities', 'equiptments'));
        } else {
            $activities = Activity::where('application_id', $application->id)->groupBy('activity_id')->get();
            return view('vendor.application.partials.modal-activity', compact('application', 'types', 'activities', 'equiptments'));
        }
    }

    public function applicationCancel(Request $request){
        $application = Application::find($request->id);
        $application->status = 6;
        $application->remark = $request->remark;

        if($application->save()){
            $equiptments = Equiptment::where('application_id', $request->id)->get();
            foreach($equiptments as $e){
                $e->status = 1;
                $e->save();
            }
        }
        return "success";
    }

    public function modalPayment(Request $request){
        $application = Application::find($request->id);
        $price = Quotation::where('application_id', $request->id)->sum('price');
        return view('vendor.application.partials.modal-payment', compact('application', 'price'));
    }

    public function uploadPayment(Request $request, $id){
        $filename = uniqid().'.'.$request->receipt->extension();  
        if($request->receipt->move(public_path('uploads/payments'), $filename)){
            $payment = new Payment;
            $payment->application_id = $id;
            $payment->file = $filename;
            if($payment->save()){
                return "success";
            }
        }

    }
}
