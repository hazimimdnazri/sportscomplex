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
use App\LFacilityGroup;

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
        return view('registration', compact('memberships'));
    }

    public function submitRegister(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 2;
        $user->password = Hash::make(123456);

        if($user->save()){
            $members = new CustomerDetail;
            $members->user_id = $user->id;
            $members->ic = $request->ic;
            $members->phone = $request->phone;
            $members->dob = date('Y-m-d', strtotime($request->dob));
            $members->address = $request->address;
            $members->zipcode = $request->zipcode;
            $members->city = $request->city;
            $members->state = $request->state;
            $members->membership = $request->membership;
            $members->cycle = $request->cycle;
            $members->cycle_start = date('Y-m-d');
            if($request->cycle == 1){
                $members->cycle_end = date('Y-m-d', strtotime('+1 month'));
            } else {
                $members->cycle_end = date('Y-m-d', strtotime('+1 year'));
            }
            if($members->save()){
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
        $facilities = LFacilityGroup::all();
        return view('calendar', compact('reservations', 'facilities'));
    }

    public function transactions(){
        return view('transactions');
    }

    public function facilityCalendar(Request $request){
        $group = $request->facility;
        $facilities = LFacility::where('group', $group)->pluck('id');
        $reservations = Reservation::whereIn('facility_id', $facilities)->get();
        return view('partials.calendar', compact('reservations'));
    }
}
