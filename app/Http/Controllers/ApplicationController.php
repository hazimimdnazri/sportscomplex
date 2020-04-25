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
use App\Activity;
use App\Facility;
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
        if($request->type == 1){
            $reservations = Facility::where('application_id', $request->id)->get();
        } else {
            $reservations = Activity::where('application_id', $request->id)->groupBy('activity_id')->selectRaw('*, sum(price) as sum')->get();
        }
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
        $venues = LVenue::all();
        $equiptments = Equiptment::where('application_id', $request->id)->get();
        $list_activity = LActivity::all();
        $application->type = $request->type;
        if($application->save()){
            if($request->type == 1){
                $facilities = Facility::where('application_id', $request->id)->get();
                return view('shared.asset', compact('facilities', 'venues', 'id', 'user', 'date', 'equiptments'));
            } else if($request->type == 2) {
                $activities = Activity::where('application_id', $request->id)->get();
                return view('shared.activity', compact('list_activity', 'activities', 'id', 'user', 'date', 'equiptments'));
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
            $facilities = Facility::where('application_id', $application->id)->get();
            return view('admin.applications.partials.modal-facility', compact('application', 'types', 'facilities', 'equiptments'));
        } else {
            $activities = Activity::where('application_id', $application->id)->get();
            return view('admin.applications.partials.modal-activity', compact('application', 'types', 'activities', 'equiptments'));
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
            $application->approved_by = Auth::user()->id;

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
        $facility = new Facility;
        $start_time = date('H:i:s', strtotime($request->start_time));
        $facility->application_id = $id;
        $facility->sport_id = $request->sport;
        $facility->duration = $request->duration;
        $facility->price = $request->duration * LSport::find($request->sport)->price;
        $facility->discount = 0;
        $facility->start_date = date("Y-m-d $start_time", strtotime(Application::find($id)->date));
        $facility->end_date = date('Y-m-d H:i:s', strtotime($facility->start_date) + (60*60*$facility->duration));
        
        if($facility->save()){
            return back();
        }
    }

    public function submitActivity(Request $request, $id){
        for($i = 0; $i < $request->quantity; $i++){
            $activity = new Activity;
            $activity->application_id = $id;
            $activity->activity_id = $request->activity;
            if($request->price == 1){
                $activity->price = LActivity::find($request->activity)->public;
            } else if($request->price == 2){
                $activity->price = LActivity::find($request->activity)->students;
            } else {
                $activity->price = LActivity::find($request->activity)->underage;
            }
            
            $activity->discount = 0;

            if(Auth::user()->role == 4){
                $activity->price_type = 4;
                $activity->price = LActivity::find($request->activity)->public;
            } else {
                $activity->price_type = $request->price;
            }

            if($activity->save()){
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
        $equiptment->price = LEquiptment::find($request->equiptment)->price;
        $equiptment->discount = 0;
        $equiptment->equiptment_id = $request->equiptment;
        if($equiptment->save()){
            return "success";
        }
    }

    public function ajaxSports(Request $request){
        $sports = LSport::where('venue', $request->venue)->get();
        return view('partials.select-sports', compact('sports'));
    }

    public function deleteItem(Request $request){
        if($request->type == 1){
            $item = Facility::find($request->id);
        } else {
            $item = Activity::find($request->id);
        }

        if($item->delete()){
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
        $reservations = Facility::whereIn('sport_id', $sports)->get();
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

    public function approveQuotation(Request $request, $id){
        $application = Application::find($id);

        if(isset($request->facility)){
            foreach(array_keys($request->facility) as $f){
                $facility = Facility::find($f);
                $facility->price = $request->facility[$f];
                $facility->discount = 0;
                $facility->save();
            }
        } else {
            $activities = Activity::where('application_id', $id)->get();
            foreach($activities as $a){
                $quotation = new Quotation;
                $quotation->application_id = $id;
                $quotation->item_id = $a->id;
                $quotation->price = $request->activity;
                $quotation->save();
            }
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
