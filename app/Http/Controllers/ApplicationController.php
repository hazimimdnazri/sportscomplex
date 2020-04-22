<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LVenue;
use App\LSport;
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
use App\LEquiptment;
use App\Equiptment;
use App\LCustomerType;
use App\Membership;
use App\LInstitution;
use App\Quotation;
use Hash;

class ApplicationController extends Controller
{
    public function index(){
        $assets = LFacility::all();
        $applications = Application::all()->where('flag', 1);
        return view('admin.applications.application', compact('assets', 'applications'));
    }

    public function details(Request $request, $id){
        $application = Application::find($id);
        $equiptments = Equiptment::where('application_id', $id)->get();
        if(User::find($application->user_id)->role != 4){
            return view('admin.applications.details', compact('application', 'equiptments'));
        } else {
            return view('admin.applications.details-vendor', compact('application', 'equiptments'));
        }
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

    public function vendorItemType(Request $request){
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
                return view('admin.applications.partials.vendor-facility', compact('reservations', 'venues', 'id', 'user', 'date', 'equiptments'));
            } else if($request->type == 2) {
                return view('admin.applications.partials.vendor-activity', compact('reservations', 'activities', 'id', 'user', 'date', 'equiptments'));
            } else {
                return NULL;
            }
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
                return view('shared.asset', compact('reservations', 'venues', 'id', 'user', 'date', 'equiptments'));
            } else if($request->type == 2) {
                return view('shared.activity', compact('reservations', 'activities', 'id', 'user', 'date', 'equiptments'));
            } else {
                return NULL;
            }
        }
    }

    public function activityModal(){
        $types = LCustomerType::all();
        $institutions = LInstitution::all();
        return view('admin.applications.partials.modal-application', compact('types', 'institutions'));
    }

    public function viewModal(Request $request){
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
            return view('admin.applications.partials.modal-facility', compact('application', 'types', 'reservations', 'equiptments'));
        } else {
            $reservations = Reservation::where('application_id', $application->id)->where('type', 2)->get();
            return view('admin.applications.partials.modal-activity', compact('application', 'types', 'reservations', 'equiptments'));
        }
    }

    public function submitApplication(Request $request){
        if($request->post_id == ''){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = 2;
            $user->password = Hash::make(123456);

            if($user->save()){
                $details = new CustomerDetail;
                $details->user_id = $user->id;
                $details->type = $request->type;
                $details->nationality = $request->nationality;

                if($request->nationality == 1){
                    $details->ic = $request->ic;
                    $date = str_split(substr($request->ic, 0, 6), 2);
                    $details->dob = date('Y-m-d', strtotime("$date[0]-$date[1]-$date[2]"));
                } else {
                    $details->passport = $request->passport;
                    $details->dob = date('Y-m-d', strtotime(0));
                }

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
                }
            }

            $user_id = $user->id;
        } else {
            $user_id = $request->post_id;
        }
        $application = new Application;
        $application->user_id = $user_id;
        $application->date = date('Y-m-d');
        $application->registered_by = Auth::user()->id;
        if($application->save()){
            return redirect('admin/application/'.$application->id);
        }
    }

    public function paymentModal(Request $request){
        $application = Application::find($request->id);
        $deposit = $request->deposit;
        $id = $request->id;
        $discount = Membership::where('user_id', $application->user_id)->orderBy('cycle_end', 'DESC')->first();
        if($discount){
            $discount = $discount->r_membership->discount;
        } else {
            $discount = 0;
        }
        $total = $request->ftotal + $request->etotal;
        return view('admin.applications.partials.modal-payment', compact('ftotal', 'etotal', 'total', 'discount', 'id', 'deposit'));
    }

    public function ajaxPayment(Request $request, $id){
        $trasaction = new Transaction;
        if($request->type == "B"){
            $application = Application::find($id);
            $reservation = Reservation::where('application_id', $id)->get();
            $equiptment = Equiptment::where('application_id', $id);
            $equiptment->update(['status' => 2]);

            $discount = Membership::where('user_id', $application->user_id)->orderBy('cycle_end', 'DESC')->first();
            if($discount){
                $discount = $discount->r_membership->discount;
            } else {
                $discount = 0;
            }
            
            $application->event = $request->event;
            $application->status = 5;

            $user = User::find($application->user_id);
            $trasaction->trans_number = $request->type.$id;
            $trasaction->trans_type = $request->type;
            $trasaction->date = date('Y-m-d');
            $trasaction->application_id = $id;
            $trasaction->customer_id = $application->user_id;
            $trasaction->tax = 0;
            $trasaction->membership_discount = $discount;
            $trasaction->general_discount = 0;
            $trasaction->subtotal = number_format($request->subtotal, 2);
            $trasaction->total = number_format($request->total, 2);
            $trasaction->paid = number_format($request->paid, 2);
            $trasaction->trans_changes = number_format($request->change, 2);

            if($application->save() && $trasaction->save()){
                return "success";
            }
        }
        
        return $trasaction;
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
        $reservation->type = 1;
        $reservation->application_id = $id;
        $reservation->sport = $request->sport;
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
            $reservation->type = 2;
            $reservation->activity = $request->activity;
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

    public function addEquiptment(Request $request){
        $id = $request->id;
        $equiptments = LEquiptment::all();
        return view('partials.modal-equiptment', compact('equiptments', 'id'));
    }

    public function submitEquiptment(Request $request, $id){
        $equiptment = new Equiptment;
        $equiptment->application_id = $id;
        $equiptment->equiptment_id = $request->equiptment;
        if($equiptment->save()){
            return "success";
        }
    }

    public function ajaxSports(Request $request){
        $sports = LSport::where('venue', $request->venue)->get();
        return view('partials.select-sports', compact('sports'));
    }

    public function deleteFacility(Request $request){
        $reservation = Reservation::find($request->id);
        if($reservation->delete()){
            return "success";
        }
    }

    public function deleteEquiptment(Request $request){
        $equiptment = Equiptment::find($request->id);
        if($equiptment->delete()){
            return "success";
        }
    }

    public function miniCalendar(Request $request){
        $date = $request->date;
        $venue = $request->venue;
        $facilities = LFacility::where('venue', $venue)->get();
        $sports = LSport::where('venue', $venue)->pluck('id');
        $reservations = Reservation::whereIn('sport', $sports)->get();
        return view("partials.calendar-mini", compact('facilities', 'reservations', 'date'));
    }

    public function qr(){
        return QrCode::size(500)->generate('123');
    }

    public function applicationApprove(Request $request){
        $application = Application::find($request->id);
        $application->status = 5;

        if($application->save()){
            $equiptments = Equiptment::where('application_id', $request->id)->get();
            foreach($equiptments as $e){
                $e->status = 2;
                $e->save();
            }
        }
        return "success";
    }

    public function applicationReject(Request $request){
        $application = Application::find($request->id);
        $application->status = 6;

        if($application->save()){
            $equiptments = Equiptment::where('application_id', $request->id)->get();
            foreach($equiptments as $e){
                $e->status = 1;
                $e->save();
            }
        }
        return "success";
    }

    public function approveQuotation(Request $request, $id){
        $application = Application::find($id);

        foreach(array_keys($request->facility) as $f){
            $quotation = new Quotation;
            $quotation->application_id = $id;
            $quotation->reservation_id = $f;
            $quotation->price = $request->facility[$f];
            $quotation->save();
        }
        $application->status = 3;
        if($application->save()){
            return "success";
        }   
    }

    public function confirmPayment(Request $request){
        $application = Application::find($request->id);
        $application->status = 5;
        if($application->save()){
            foreach(Equiptment::where('application_id', $request->id) as $e){
                $e->status = 2;
                $e->save();
            }
            return "success";
        }
    }
}
