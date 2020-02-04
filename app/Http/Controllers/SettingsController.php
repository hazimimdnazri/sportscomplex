<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\LFacility;
use App\User;
use App\LMembership;
use App\Customer;
use App\LFacilityType;
use App\LActivity;
use App\LEquiptment;

class SettingsController extends Controller
{
    public function categories(){
        $assets = LFacilityType::all();
        return view('settings.categories', compact('assets'));
    }

    public function submitCategory(Request $request){
        $assets = new LFacilityType;
        if($request->id){
            $assets = LFacilityType::find($request->id);
        }
        $assets->type = $request->asset;
        $assets->remark = $request->remark;

        if($assets->save()){
            return back();
        }
    }
    
    public function facilities(){
        $facilities = LFacility::all();
        return view('settings.facilities', compact('facilities'));
    }

    public function submitFacilities(Request $request){
        $facility = new LFacility;
        if($request->id){
            $facility = LFacility::find($request->id);
        }
        $facility->facility = $request->facility;
        $facility->type = $request->category;
        $facility->price = $request->price;
        $facility->min_hour = $request->min_hour;
        $facility->remark = $request->remark;

        if($facility->save()){
            return back();
        }
    }

    public function equiptments(){
        $equiptments = LEquiptment::all();
        return view('settings.equiptments', compact('equiptments', 'facilities'));
    }

    public function submitEquiptments(Request $request){
        $equiptment = new LEquiptment;
        if($request->id){
            $equiptment = LEquiptment::find($request->id);
        }
        $equiptment->equiptment = $request->equiptment;
        $equiptment->facility = $request->facility;
        $equiptment->remark = $request->remark;

        if($equiptment->save()){
            return back();
        }
    }
    
    public function activities(){
        $activities = LActivity::all();
        return view('settings.activities', compact('activities'));
    }

    public function submitActivity(Request $request){
        $activity = new LActivity;
        if($request->id){
            $activity = LActivity::find($request->id);
        }
        $activity->activity = $request->activity;
        $activity->public = $request->public;
        $activity->students = $request->students;
        $activity->underage = $request->underage;
        $activity->deposit = $request->deposit;
        $activity->remark = $request->remark;

        if($activity->save()){
            return back();
        }
    }
    
    public function submitMembership(Request $request){
        $membership = new LMembership;
        if($request->id){
            $membership = LMembership::find($request->id);
        }
        $membership->membership = $request->membership;
        $membership->discount = $request->discount;
        $membership->monthly = $request->monthly;
        $membership->anually = $request->anually;

        if($membership->save()){
            return back();
        }
    }

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

    public function facilitiesModal(Request $request){
        $facility = new LFacility;
        if(isset($request->id)){
            $facility = LFacility::find($request->id);
            if(isset($request->action) == "delete"){
                if($facility->delete()){
                    return "success";
                }
            }
        }
        $types = LFacilityType::all();
        $id = $request->id;
        return view('settings.partials.facilities-modal', compact('types', 'facility', 'id'));
    }

    public function activitiesModal(Request $request){
        $activity = new LActivity;
        if(isset($request->id)){
            $activity = LActivity::find($request->id);
            if(isset($request->action) == "delete"){
                if($activity->delete()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('settings.partials.activities-modal', compact('activity', 'id'));
    }

    public function membershipsModal(Request $request){
        $membership = new LMembership;
        if(isset($request->id)){
            $membership = LMembership::find($request->id);
            if(isset($request->action) == "delete"){
                if($membership->delete()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('settings.partials.memberships-modal', compact('membership', 'id'));
    }

    public function categoriesModal(Request $request){
        $categories = new LFacilityType;
        if(isset($request->id)){
            $categories = LFacilityType::find($request->id);
            if(isset($request->action) == "delete"){
                if($categories->delete()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('settings.partials.categories-modal', compact('categories', 'id'));
    }

    public function equiptmentsModal(Request $request){
        $facilities = LFacility::all();
        $equiptment = new LEquiptment;
        if(isset($request->id)){
            $equiptment = LEquiptment::find($request->id);
            if(isset($request->action) == "delete"){
                if($equiptment->delete()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('settings.partials.equiptments-modal', compact('equiptment', 'id', 'facilities'));
    }
}
