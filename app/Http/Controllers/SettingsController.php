<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\LMembership;
use App\Customer;
use App\LActivity;

class SettingsController extends Controller
{

    public function users(){
        $users = User::all();
        return view('settings.users', compact('users'));
    }

    public function submitUser(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make(123456);
        $user->role = 2;

        if($user->save()){
            return back();
        }
    }

    public function profile(){
        return view('settings.profile');
    }

    public function customers(){
        $customers = Customer::all();
        return view('settings.customers', compact('customers'));
    }

    public function membership(){
        $memberships = LMembership::all();
        return view('settings.membership', compact('memberships'));
    }

    public function submitMembership(Request $request) {

        $membership = new LMembership;
        $membership->membership = $request->membership;
        $membership->discount = $request->discount;
        $membership->monthly = $request->monthly;
        $membership->anually = $request->anually;
        
        if($membership->save()){
            return back();
        }
    }

    public function editCustomer(Request $request){
        $customer = Customer::find($request->id);
        $memberships = LMembership::all();
        return view('shared.customer_details', compact('customer', 'memberships'));
    }

    public function submitEditCustomer(Request $request){
        $customer = Customer::find($request->id);
        $customer->name = $request->name;
        $customer->ic = $request->ic;
        $customer->dob = date('Y-m-d', strtotime($request->dob));
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->zipcode = $request->zipcode;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->membership = $request->membership;

        if($customer->save()){
            return back();
        }
    }
}
