<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\LMembership;

class MembershipController extends Controller
{

    public function membership(){
        $memberships = LMembership::all();
        return view('settings.membership.membership', compact('memberships'));
    }

    public function submitMembership(Request $request) {

        if(array_key_exists('id', $request->all())){
            $membership = LMembership::find($request->id);
        }
        else {
            $membership = new LMembership;
        }

        $membership->membership = $request->membership;
        $membership->discount = $request->discount;
        $membership->monthly = $request->monthly;
        $membership->anually = $request->anually;
        $membership->status = 1;
        
        if($membership->save()){
            alert()->success('Saved', 'Successful');
            return redirect()->to('settings/membership');
        }
    }

    public function add(){

        $membership = new LMembership;    
        return view('settings.membership.add', compact('membership'));
    }

    public function edit($id){

        $membership = LMembership::find($id);
        return view('settings.membership.edit', compact('membership'));
    }  

    public function deactivate($id){

        $membership = LMembership::find($id);

        if($membership){

        	$membership->status = 0;

	        if($membership->save()){

		        alert()->success('Deactivated', 'Successful');
		        return redirect()->to('settings/membership');
	        }
	    }
    }  
}