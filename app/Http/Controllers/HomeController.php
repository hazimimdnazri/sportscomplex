<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\Application;

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
    }

    public function register(){
        return view('registration');
    }

    public function submitRegister(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()){
            return redirect('login');
        }
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
