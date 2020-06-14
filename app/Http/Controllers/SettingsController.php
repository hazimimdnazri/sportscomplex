<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\LFacility;
use App\User;
use App\LMembership;
use App\Customer;
use App\LVenue;
use App\LSport;
use App\LActivity;
use App\LEquiptment;
use App\LInstitution;
use App\LRole;

class SettingsController extends Controller
{
    public function venues(){
        $venues = LVenue::all();
        return view('admin.settings.venues', compact('venues'));
    }

    public function submitVenue(Request $request){
        $venues = new LVenue;
        if($request->id){
            $venues = LVenue::find($request->id);
        }
        $venues->venue = $request->asset;
        $venues->remark = $request->remark;

        if($venues->save()){
            return back();
        }
    }

    public function facilities(){
        $facilities = LFacility::all();
        return view('admin.settings.facilities', compact('facilities'));
    }

    public function submitFacility(Request $request){
        $facility = new LFacility;
        if($request->id){
            $facility = LFacility::find($request->id);
        }
        $facility->venue = $request->category;
        $facility->facility = $request->group;
        $facility->remark = $request->remark;

        if($facility->save()){
            return back();
        }
    }
    
    public function sports(){
        $sports = LSport::all();
        return view('admin.settings.sports', compact('sports'));
    }

    public function submitSport(Request $request){
        $sport = new LSport;
        if($request->id){
            $sport = LSport::find($request->id);
        }
        $sport->sport = $request->facility;
        $sport->venue = $request->venue;
        $sport->facility = json_encode($request->facilities);
        $sport->price = $request->price;
        $sport->min_hour = $request->min_hour;
        $sport->colour = $request->colour;
        $sport->remark = $request->remark;

        if($sport->save()){
            return back();
        }
    }

    public function institutions(){
        $institutions = LInstitution::all();
        return view('admin.settings.institutions', compact('institutions'));
    }

    public function submitInstitutions(Request $request){
        $institution = new LInstitution;
        if($request->id){
            $institution = LInstitution::find($request->id);
        }
        $institution->institution = $request->institution;
        $institution->remark = $request->remark;

        if($institution->save()){
            return back();
        }
    }

    public function equiptments(){
        $equiptments = LEquiptment::all();
        return view('admin.settings.equiptments', compact('equiptments', 'facilities'));
    }

    public function submitEquiptments(Request $request){
        $equiptment = new LEquiptment;
        if($request->id){
            $equiptment = LEquiptment::find($request->id);
        }
        $equiptment->equiptment = $request->equiptment;
        $equiptment->serial_number = $request->serial_number;
        $equiptment->price = $request->price;
        $equiptment->remark = $request->remark;

        if($equiptment->save()){
            return back();
        }
    }
    
    public function activities(){
        $activities = LActivity::all();
        return view('admin.settings.activities', compact('activities'));
    }

    public function submitActivity(Request $request){
        $activity = new LActivity;
        if($request->id){
            $activity = LActivity::find($request->id);
        }
        $activity->activity = $request->activity;
        $activity->venue = $request->venue;
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
        $roles = LRole::all();
        return view('admin.settings.users', compact('users', 'roles'));
    }

    public function changeRole(Request $request){
        $user = User::find($request->id);
        $user->role = $request->role;
        if($user->save()){
            return "Role for ".$user->name." has been changed.";
        } else {
            return "An error occured!";
        }
    }

    public function submitUser(Request $request){
        $user = new User;
        if($request->id){
            $user = User::find($request->id);
            if($request->password != '123456'){
                $user->password = Hash::make($request->password);
            }
        } else {
            $user->password = Hash::make(123456);
            $user->role = 2;
        }
        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()){
            return back();
        }
    }

    public function profile(){
        return view('admin.settings.profile');
    }

    public function customers(){
        $customers = Customer::all();
        return view('admin.settings.customers', compact('customers'));
    }

    public function membership(){
        $memberships = LMembership::all();
        return view('admin.settings.membership', compact('memberships'));
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

    public function sportsModal(Request $request){
        $sport = new LSport;
        if(isset($request->id)){
            $sport = LSport::find($request->id);
            if(isset($request->action) == "delete"){
                if($sport->delete()){
                    return "success";
                }
            }
        }
        $venues = LVenue::all();
        $facilities = LFacility::all();
        $id = $request->id;
        return view('admin.settings.partials.sports-modal', compact('venues', 'facilities', 'sport', 'id'));
    }

    public function activitiesModal(Request $request){
        $venues = LVenue::all();
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
        return view('admin.settings.partials.activities-modal', compact('activity', 'id', 'venues'));
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
        return view('admin.settings.partials.memberships-modal', compact('membership', 'id'));
    }

    public function venuesModal(Request $request){
        $venues = new LVenue;
        if(isset($request->id)){
            $venues = LVenue::find($request->id);
            if(isset($request->action) == "delete"){
                if($venues->delete()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('admin.settings.partials.venues-modal', compact('venues', 'id'));
    }

    public function institutionsModal(Request $request){
        $institutions = new LInstitution;
        if(isset($request->id)){
            $institutions = LInstitution::find($request->id);
            if(isset($request->action) == "delete"){
                if($institutions->delete()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('admin.settings.partials.institutions-modal', compact('institutions', 'id'));
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
        return view('admin.settings.partials.equiptments-modal', compact('equiptment', 'id', 'facilities'));
    }

    public function usersModal(Request $request){
        $user = new User;
        if(isset($request->id)){
            $user = User::find($request->id);
            if(isset($request->action) == "delete"){
                if( $user->flag == 1){
                    $user->flag = 0;
                } else {
                    $user->flag = 1;
                }
                if($user->save()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('admin.settings.partials.users-modal', compact('user', 'id'));
    }

    public function passwordModal(Request $request){
        $id = $request->id;
        return view('admin.settings.partials.password-modal', compact('id'));
    }

    public function changePassword(Request $request){
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        if($user->save()){
            return 'success';
        }
    }

    public function facilitiesModal(Request $request){
        $venues = LVenue::all();
        $facility = new LFacility;
        if(isset($request->id)){
            $facility = LFacility::find($request->id);
            if(isset($request->action) == "delete"){
                if($facility->delete()){
                    return "success";
                }
            }
        }
        $id = $request->id;
        return view('admin.settings.partials.facilities-modal', compact('facility', 'id', 'venues'));
    }

    public function selectFacilities(Request $request){
        if($request->id){
            $selectedFac = LSport::find($request->id)->facility;
        } else {
            $selectedFac = NULL;
        }
        
        $facilities = LFacility::where('venue', $request->venue_id)->get();
        return view('admin.settings.partials.select-facilities', compact('facilities', 'id', 'selectedFac'));
    }
}
