<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\Application;
use App\LMembership;
use App\CustomerDetail;
use App\Facility;
use App\LFacility;
use App\LVenue;
use App\LSport;
use App\LState;
use App\LCustomerType;
use App\Membership;
use App\LInstitution;
use App\StudentDetail;
use App\StaffDetail;
use App\VendorDetail;
use App\VendorPic;
use App\LiveFacility;
use App\LiveActivity;
use App\LiveCollection;
use App\CustGender;
use App\DashboardFinancial;
use App\Transaction;
use App\Activity;
use App\VenueCollection;
use Mail;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $role = Auth::user()->role;
        if($role == 1 || $role == 2){
            return redirect('admin/dashboard');
        } else if($role == 4){
            return redirect('vendor/dashboard');
        } else {
            return redirect('customer/dashboard');
        }
    }

    public function unauthorized(){
        return "You are unauthorized";
    }

    public function register(){
        return view('auth.register');
    }

    public function verify(){
        return view('verify');
    }

    public function verifyAccount(){
        if(isset($_GET['token_id'])){
            $token = base64_decode($_GET['token_id']);
            $user = User::where('email', $token)->first();
            if($user){
                $user->status = 2;
                if($user->save()){
                    return view('activated');
                }
            } else {
                return view('whut');
            }
        } else {
            return view('whut');
        }
    }

    public function submitRegister(Request $request){
        if(User::where('email', strtolower($request->email))->first()){
            return 'email exist';
        } else if(CustomerDetail::where('ic', strtolower($request->ic))->first()){
            return 'ic exist';
        } else if(CustomerDetail::where('passport', strtolower($request->passport))->first()){
            return 'passport exist';
        } else {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            if($user->save()){
                $details = new CustomerDetail;
                $details->user_id = $user->id;
                $details->type = 1;
                $details->nationality = $request->nationality;
                if($request->nationality == 1){
                    $details->ic = $request->ic;
                    $date = str_split(substr($request->ic, 0, 6), 2);
                    $details->dob = date('Y-m-d', strtotime("$date[0]-$date[1]-$date[2]"));
                } else {
                    $details->passport = $request->passport;
                }

                if($details->save()){
                    $vars["email"] = $user->email;
                    $vars["name"] = $user->name;
                    $vars["token"] = base64_encode($user->email);
                    try {
                        Mail::send(["html" => "shared.mail-verify"], $vars, function($message) use ($vars){
                            $message->from("admin@esurvey.jkr.gov.my", "EduCity Sports Centre");
                            $message->to($vars["email"]);
                            $message->sender("admin@esurvey.jkr.gov.my", "EduCity Sports Centre");
                            $message->subject("EduCity Sports Centre Account Activation");
                        });
                    } catch(\Exception $err) {
                        return $err;
                    }
                }
            }
            return "success";
        }
    }

    public function registerUser(){
        $states = LState::all();
        $types = LCustomerType::all();
        $institutions = LInstitution::all();
        return view('admin.registration-user', compact('types', 'institutions', 'states'));
    }

    public function submitUserRegister(Request $request){
        $email = User::where('email', $request->email)->first();
        $ic = CustomerDetail::where('ic', $request->ic)->first();
        if($email){
            return 'email';
        } else if($ic){
            return 'ic';
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 3;
        $user->status = 1;
        $user->password = Hash::make(123456);

        if($user->save()){
            $members = new CustomerDetail;
            $members->user_id = $user->id;
            $members->nationality = $request->nationality;
            $members->gender = $request->gender;

            if($members->nationality == 1){
                $members->ic = $request->ic;
                $members->passport = NULL;
            } else {
                $members->passport = $request->passport;
                $members->ic = NULL;
            }

            $members->phone = $request->phone;
            $members->dob = date('Y-m-d', strtotime($request->dob));
            $members->address = $request->address;
            $members->zipcode = $request->zipcode;
            $members->type = $request->type;
            $members->city = $request->city;
            $members->state = $request->state;

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

            if($members->save()){
                $vars["email"] = $user->email;
                $vars["name"] = $user->name;
                $vars["token"] = base64_encode($user->email);
                try {
                    Mail::send(["html" => "shared.mail-verify"], $vars, function($message) use ($vars){
                        $message->from("admin@esurvey.jkr.gov.my", "EduCity Sports Centre");
                        $message->to($vars["email"]);
                        $message->sender("admin@esurvey.jkr.gov.my", "EduCity Sports Centre");
                        $message->subject("EduCity Sports Centre Account Activation");
                    });
                } catch(\Exception $err) {
                    return $err;
                }
                return "success";
            }
        }
    }

    public function registerVendor(){
        $states = LState::all();
        return view('admin.vendors.register', compact('states'));
    }

    public function viewVendor($id){
        $vendor = User::find($id);
        $states = LState::all();
        return view('admin.vendors.details', compact('vendor', 'states'));
    }

    public function submitRegisterVendor(Request $request){

        $email = User::where('email', $request->email)->first();
        if($email){
            return 'duplicate';
        }

        $vendor = new User;
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->role = 4;
        $vendor->status = 1;
        $vendor->password = Hash::make($request->password);

        if($vendor->save()){
            $vendorDetail = new VendorDetail;
            $vendorDetail->user_id = $vendor->id;
            $vendorDetail->phone_mobile = $request->phone_mobile;
            $vendorDetail->phone_office = $request->phone_office;
            $vendorDetail->company_registration = $request->company_reg;
            $vendorDetail->address = $request->address;
            $vendorDetail->city = $request->city;
            $vendorDetail->state = $request->state;
            $vendorDetail->zipcode = $request->zipcode;
            $vendorDetail->nationality = $request->nationality;

            if($vendorDetail->save()){
                for($i = 0; $i < count($request->pic_email); $i++){
                    $pic = new VendorPic;
                    $pic->vendor_id = $vendor->id;
                    $pic->name = $request->pic_name[$i];
                    $pic->email = $request->pic_email[$i];
                    $pic->phone_mobile = $request->pic_phone[$i];
                    $pic->type = $i;
                    $pic->save();
                }

                $vars["email"] = $vendor->email;
                $vars["name"] = $vendor->name;
                $vars["token"] = base64_encode($vendor->email);
                try {
                    Mail::send(["html" => "shared.mail-verify"], $vars, function($message) use ($vars){
                        $message->from("admin@esurvey.jkr.gov.my", "EduCity Sports Centre");
                        $message->to($vars["email"]);
                        $message->sender("admin@esurvey.jkr.gov.my", "EduCity Sports Centre");
                        $message->subject("EduCity Sports Centre Account Activation");
                    });
                } catch(\Exception $err) {
                    return $err;
                }
            }
        }

        return "success";
    }

    public function submitEditVendor(Request $request, $id){
        $vendor = User::find($id);
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->role = 4;
        $vendor->status = 1;
        $vendor->password = Hash::make($request->password);

        if($vendor->save()){
            $vendorDetail = VendorDetail::where('user_id', $id)->first();
            $vendorDetail->user_id = $vendor->id;
            $vendorDetail->phone_mobile = $request->phone_mobile;
            $vendorDetail->phone_office = $request->phone_office;
            $vendorDetail->company_registration = $request->company_reg;
            $vendorDetail->address = $request->address;
            $vendorDetail->city = $request->city;
            $vendorDetail->state = $request->state;
            $vendorDetail->zipcode = $request->zipcode;
            $vendorDetail->nationality = $request->nationality;

            if($vendorDetail->save()){
                VendorPic::where('vendor_id', $id)->delete();
                for($i = 0; $i < count($request->pic_email); $i++){
                    $pic = new VendorPic;
                    $pic->vendor_id = $vendor->id;
                    $pic->name = $request->pic_name[$i];
                    $pic->email = $request->pic_email[$i];
                    $pic->phone_mobile = $request->pic_phone[$i];
                    $pic->type = $i;
                    $pic->save();
                }
            }
        }
        return "success";
    }

    public function submitEditCust(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        $members = CustomerDetail::where('user_id', $id)->first();
        if(!($members)){
            $members = new CustomerDetail;
        }

        $members->user_id = $id;
        $members->phone = $request->phone;
        $members->dob = date('Y-m-d', strtotime($request->dob));
        $members->address = $request->address;
        $members->zipcode = $request->zipcode;
        $members->type = $request->type;
        $members->city = $request->city;
        $members->state = $request->state;
        $members->gender = $request->gender;
        $members->nationality = $request->nationality;

        if($members->nationality == 1){
            $members->ic = $request->ic;
            $members->passport = NULL;
        } else {
            $members->passport = $request->passport;
            $members->ic = NULL;
        }

        if($request->type == 3){
            $student = StudentDetail::where('user_id', $id)->first();
            if($student == ''){
                $student = new StudentDetail;
            }
            $student->user_id = $id;
            $student->student_id = $request->student_id;
            $student->institution = $request->institution;
            $student->save();

        } else if($request->type == 2){
            $staff = StaffDetail::where('user_id', $id)->first();
            if($staff == ''){
                $staff = new StaffDetail;
            }
            $staff->user_id = $id;
            $staff->staff_id = $request->staff_id;
            $staff->company = $request->company;
            $staff->save();
        }

        if($user->save() && $members->save()){
            return "success";
        }
    }

    public function ajaxMembershipPrice(Request $request){
        $price = LMembership::where('id', $request->membership)->first();
        return $price;
    }

    public function login(){
        return view('auth.login');
    }

    public function submitLogin(Request $request){
        
    }

    public function dashboard(){
        $facilities = LiveFacility::groupBy('venue')->get();
        $activities = LiveActivity::groupBy('venue')->get();
        $collections = LiveCollection::all();
        $genders = CustGender::all();
        $venues = LVenue::all();
        $vcs = VenueCollection::all();
        return view('admin.dashboard', compact('facilities', 'activities', 'collections', 'venues', 'genders', 'vcs'));
    }

    public function dashboardFinancial(){
        $facilities = LiveFacility::groupBy('venue')->get();
        $activities = LiveActivity::groupBy('venue')->get();
        $collections = LiveCollection::all();
        $venues = LVenue::all();
        $financials = DashboardFinancial::all();
        return view('admin.dashboard-financial', compact('facilities', 'activities', 'collections', 'venues', 'financials'));
    }

    public function calendar(){
        $venues = LVenue::all();
        return view('admin.calendar', compact('reservations', 'venues'));
    }

    public function transactions(){
        return view('admin.transactions');
    }

    public function customers(){
        $customers = User::where('role', 3)->where('flag', 1)->get();
        return view('admin.customers', compact('customers'));
    }

    public function deleteCustomer(Request $request){
        $user = User::find($request->id);
        $user->flag = 0;
        if($user->save()){
            return 'success';
        }
    }

    public function editCustomer($id){
        $user = User::find($id);
        $states = LState::all();
        $types = LCustomerType::all();
        $institutions = LInstitution::all();
        return view('admin.customer-edit', compact('user', 'states', 'types', 'institutions'));
    }

    public function facilityCalendar(Request $request){
        $venue = $request->venue;
        $facilities = LFacility::where('venue', $venue)->get();
        $sports = LSport::where('venue', $venue)->pluck('id');
        $reservations = Facility::whereIn('sport_id', $sports)->get();
        return view('partials.calendar', compact('reservations', 'facilities'));
    }

    public function vendors(){
        $vendors = User::where('role', 4)->where('flag', 1)->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function membershipModal(Request $request){
        $id = $request->id;
        $memberships = LMembership::all();
        $membership = Membership::where('user_id', $id)->orderBy('cycle_end', 'DESC')->get();
        return view('admin.partials.modal-membership', compact('memberships', 'id', 'membership'));
    }

    public function renewMembership(Request $request, $id){
        $membership = new Membership;
        $membership->user_id = $id;
        $membership->membership = $request->membership;
        $membership->cycle = $request->cycle;
        $membership->cycle_start = date('Y-m-d');
        if($request->cycle == 1){
            $membership->cycle_end = date('Y-m-d', strtotime('+1 month'));
        } else {
            $membership->cycle_end = date('Y-m-d', strtotime('+1 year'));
        }

        if($membership->cycle == 1){
            $total = $membership->r_membership->monthly;
        } else {
            $total = $membership->r_membership->anually;
        }
        if($membership->save()){
            return view('admin.partials.modal-payment', compact('total', 'id'));
        }
    }

    public function paymentMembership(Request $request, $id){
        $transaction = new Transaction;
        $transaction->trans_number = $request->type.$id;
        $transaction->trans_type = "POS";
        $transaction->date = date('Y-m-d');
        $transaction->customer_id = $id;
        $transaction->tax = 0;
        $transaction->payment_type = 2;
        $transaction->membership_discount = number_format(0, 2, '.', '');
        $transaction->general_discount = 0;
        $transaction->subtotal = number_format($request->subtotal, 2, '.', '');
        $transaction->total = number_format($request->total, 2, '.', '');
        $transaction->paid = number_format($request->paid, 2, '.', '');
        $transaction->trans_changes = number_format($request->change, 2, '.', '');
        $transaction->deposit = 0;

        if($transaction->save()){
            $membership = Membership::where('user_id', $id)->orderBy('cycle_end', 'DESC')->first();
            $membership->transaction_id = $transaction->id;
            if($membership->save()){
                return 'success';
            }
        }
    }

    public function receiptMembership(Request $request, $id){
        $transaction = Transaction::where('customer_id', $id)->orderBy('created_at', 'DESC')->first();
        $pdf = PDF::loadView('admin.receipt', compact('facility', 'activity', 'transaction'))->setPaper([0, 0, 226.772, 740 ], 'portrait');  
        $content = $pdf->output();
        $uniq = uniqid();
        if(file_put_contents(public_path('uploads/receipts/'.$uniq.'.pdf'), $content)){
            $transaction->receipt = "$uniq.pdf";
            if($transaction->save()){
                return $data = [
                    'status' => 'success',
                    'id' => "$transaction->receipt"
                ];
            }
        }
    }

    public function checkMembership(Request $request, $id){
        $membership = Membership::where('user_id', $id)->orderBy('cycle_end', 'DESC')->first();
        if($membership->cycle_start == date('Y-m-d')){
            return "success";
        }
    }

    public function deleteMembership(Request $request){
        $membership = Membership::find($request->id);
        if($membership->delete()){
            return 'success';
        }
    }

    public function changeUserPass(Request $request){
        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        if($user->save()){
            return 'success';
        }
    }

    public function loading(){
        return view('modal-loading');
    }

    public function script(){
        $trans = Transaction::where('application_id', "!=", NULL)->get();
        foreach($trans as $t){
            $deposit = 0;
            $activities = Activity::where('application_id', $t->application_id)->get();
            foreach($activities as $a){
                $deposit += $a->r_activity->deposit;
            }
            $t->deposit = $deposit;
            if(($t->total - $t->deposit) > 0){
                $t->save();
            }
        }
        return "success";
    }
}
