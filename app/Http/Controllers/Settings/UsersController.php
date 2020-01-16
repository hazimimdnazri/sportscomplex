<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    public function users(){
        $users = User::all();
        return view('settings.users.users', compact('users'));
    }

    public function submitUser(Request $request){

        if(array_key_exists('id', $request->all())){
            $asset = User::find($request->id);
        }
        else {
            $asset = new User;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password) && !empty($request->id)) {
            $user->password = Hash::make($request->password);
        }
        else {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->role;
        $user->status = 1;

        if($user->save()){

            alert()->success('Saved', 'Successful');
            return redirect()->to('settings/users');
        }
    }

    public function add(){

        $user = new User;
        return view('settings.users.add', compact('user'));
    }

    public function edit($id){

        $user = User::find($id);
        return view('settings.users.edit', compact('user'));
    }  

    public function deactivate($id){

        $user = User::find($id);

        if($user){

        	$user->status = 0;

	        if($user->save()){

		        alert()->success('Deactivated', 'Successful');
		        return redirect()->to('settings/users');
	        }
	    }
    }  
}