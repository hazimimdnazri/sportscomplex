<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LFacilityGroup;
use App\LFacility;
use App\Application;
use Auth;
use App\Reservation;
use App\LActivity;
use QrCode;
use App\Transaction;
use App\User;
use App\StudentDetail;
use App\StaffDetail;
use App\CustomerDetail;
use Hash;

class ApplicationController extends Controller
{
    public function index(){
        $assets = LFacility::all();
        $applications = Application::all();
        return view('application', compact('assets', 'applications'));
    }

    public function details(Request $request, $id){
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
            $groups = LFacilityGroup::all();
            $reservations = Reservation::where('application_id', $request->id)->get();
            return view('shared.asset', compact('reservations', 'groups', 'id'));
        } else if($request->type == 2) {

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
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make(123456);

        if($user->save()){
            $details = new CustomerDetail;
            $details->user_id = $user->id;
            $details->ic = $request->ic;
            $date = str_split(substr($request->ic, 0, 6), 2);
            $details->dob = date('Y-m-d', strtotime("$date[0]-$date[1]-$date[2]"));
            $details->type = $request->type;

            if($details->save()){
                if($request->type == 3){
                    $student = new StudentDetail;
                    $student->user_id = $user->id;
                    $student->student_id = $request->student_id;
                    $student->institution = $request->institution;
                    $student->save();

                } else if($request->type == 2){
                    $staff = new StaffDetail;
                    $staff->user_id = $user->id;
                    $staff->staff_id = $request->staff_id;
                    $staff->company = $request->company;
                    $staff->save();
                }

                $application = new Application;
                $application->user_id = $user->id;
                $application->date = date('Y-m-d');
                $application->registered_by = Auth::user()->id;
                if($application->save()){
                    return redirect('application/'.$application->id);
                }
            }
        }
    }

    public function payment($id){
        $application = Application::find($id);
        $application->status = 2;
        if($application->save()){
            $reservations = Reservation::where('application_id', $id)->get();
            $reservation = Reservation::where('application_id', $id)->first();
            $customer = User::find($application->user_id);
            return view('applications.payment', compact('customer', 'application', 'reservations'));
        }
    }

    public function ajaxSubmitPayment(Request $request){
        $application = Application::find($request->id);
        $reservation = Reservation::where('application_id', $application->id)->first();
        $trasaction = new Transaction;

        $trasaction->trans_number = "R$reservation->id";
        $trasaction->trans_type = 1;
        $trasaction->reservation_id = $reservation->id;
        $trasaction->date = date('Y-m-d');
        $trasaction->customer_id = $application->customer_id;
        $trasaction->tax = 0.00;
        $trasaction->membership_discount = 0.00;
        $trasaction->general_discount = 0.00;
        $trasaction->trans_changes = 0.00;
        $trasaction->total = $request->total;

        $application->status = 3;

        if($trasaction->save() && $application->save()){
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
        $start_time = date('H:i:s', strtotime($request->start_time));
        $reservation->application_id = $id;
        $reservation->group_id = $request->group;
        $reservation->facility_id = $request->facility;
        $reservation->duration = $request->duration;
        $reservation->start_date = date("Y-m-d $start_time", strtotime(Application::find($id)->date));
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

    public function ajaxFacilities(Request $request){
        $facilities = LFacility::where('group', $request->group)->get();
        return view('partials.select-facilities', compact('facilities'));
    }

    public function qr(){
        return QrCode::size(500)->generate('123');
    }
}
