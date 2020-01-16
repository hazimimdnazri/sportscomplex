<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\User;
use App\LMembership;
use App\Customer;

class CustomersController extends Controller
{
    public function customers(){
        $customers = Customer::all();
        return view('settings.customers.customers', compact('customers'));
    }

    public function edit(Request $request){
        $customer = Customer::find($request->id);
        $memberships = LMembership::all();
        return view('settings.customers.edit', compact('customer', 'memberships'));
    }

    public function submitCustomer(Request $request){
        //dd($request->all());
        if(array_key_exists('id', $request->all())){

            $members = Customer::find($request->id);
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
            $members->cycle_start = date('Y-m-d');
            
            if($request->cycle == 1){
                $members->cycle_end = date('Y-m-d', strtotime('+1 month'));
            } else {
                $members->cycle_end = date('Y-m-d', strtotime('+1 year'));
            }
        }
        else {
            $members = new Customer;
            $members->name = $request->name;
            $members->ic = $request->ic;
            $members->dob = date('Y-m-d', strtotime($request->dob));
            $members->phone = $request->phone;
            $members->email = $request->email;
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
        }

        if($members->save()){

            alert()->success('Saved', 'Successful');
            return redirect()->to('settings/customers');
        }
    }

    public function add(){

        $customer = new Customer;
        $memberships = LMembership::all();
        return view('settings.customers.add', compact('customer','memberships'));
    }

    public function deactivate($id){

        $customer = Customer::find($id);

        if($customer){

        	$customer->status = 0;

	        if($customer->save()){

		        alert()->success('Deactivated', 'Successful');
		        return redirect()->to('settings/customers');
	        }
	    }
    }  
}