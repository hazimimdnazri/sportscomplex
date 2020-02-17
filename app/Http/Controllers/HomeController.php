<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\Application;
use App\LMembership;
use App\CustomerDetail;
use App\Reservation;
use App\LFacility;
use App\LVenue;
use App\LSport;
use App\LCustomerType;
use App\Membership;
use App\LInstitution;
use App\StudentDetail;
use App\StaffDetail;

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
        return redirect('dashboard');
    }

    public function register(){
        $memberships = LMembership::all();
        $types = LCustomerType::all();
        $institutions = LInstitution::all();
        return view('registration', compact('memberships', 'types', 'institutions'));
    }

    public function submitRegister(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 3;
        $user->status = 2;
        $user->password = Hash::make(123456);

        if($user->save()){
            $members = new CustomerDetail;
            $members->user_id = $user->id;
            $members->ic = $request->ic;
            $members->passport = $request->passport;
            $members->phone = $request->phone;
            $members->dob = date('Y-m-d', strtotime($request->dob));
            $members->address = $request->address;
            $members->zipcode = $request->zipcode;
            $members->type = $request->type;
            $members->nationality = $request->nationality;
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

            $memberships = new Membership;
            $memberships->user_id = $user->id;
            $memberships->membership = $request->membership;
            $memberships->cycle = $request->cycle;
            $memberships->cycle_start = date('Y-m-d');
            if($request->cycle == 1){
                $memberships->cycle_end = date('Y-m-d', strtotime('+1 month'));
            } else {
                $memberships->cycle_end = date('Y-m-d', strtotime('+1 year'));
            }
            if($members->save() && $memberships->save() ){
                return back();
            }
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
        return view('dashboard');
    }

    public function calendar(){
        $venues = LVenue::all();
        return view('calendar', compact('reservations', 'venues'));
    }

    public function transactions(){
        return view('transactions');
    }

    public function customers(){
        $customers = User::where('role', 3)->get();
        return view('customers', compact('customers'));
    }

    public function facilityCalendar(Request $request){
        $venue = $request->venue;
        $facilities = LFacility::where('venue', $venue)->get();
        $sports = LSport::where('venue', $venue)->pluck('id');
        $reservations = Reservation::whereIn('sport', $sports)->get();
        return view('partials.calendar', compact('reservations', 'facilities'));
    }
}
