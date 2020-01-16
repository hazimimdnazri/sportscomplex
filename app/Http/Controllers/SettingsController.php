<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\LMembership;
use App\Customer;
use App\LActivity;

class SettingsController extends Controller
{

    public function profile(){
        return view('settings.profile');
    }

    
}
