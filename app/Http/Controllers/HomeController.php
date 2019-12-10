<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\Application;
use App\Membership;
use App\Member;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return redirect('dashboard');
    }

    public function register(){
        $memberships = Membership::all();
        return view('registration', compact('memberships'));
    }

    public function submitRegister(Request $request){
        $members = new Member;
        $members->name = $request->name;
        $members->ic = $request->ic;
        $members->email = $request->email;
        $members->phone = $request->phone;
        $members->dob = date('Y-m-d', strtotime($request->dob));
        $members->address = $request->address;
        $members->zipcode = $request->zipcode;
        $members->city = $request->city;
        $members->state = $request->state;
        $members->membership = $request->membership;
        $members->cycle = $request->cycle;

        if($members->save()){
            return back();
        }
    }

    public function ajaxMembershipPrice(Request $request){
        $price = Membership::where('id', $request->membership)->first();
        return $price;
    }

    public function login(){
        return view('auth.login');
    }

    public function submitLogin(Request $request){
        
    }

    public function dashboard(){
        $events = Application::where('flag', 1)->where('status', 3)->get();
        return view('dashboard', compact('events'));
    }

    public function calendar(){
        return view('calendar');
    }
}
