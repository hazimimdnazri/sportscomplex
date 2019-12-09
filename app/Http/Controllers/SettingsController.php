<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function assets(){
        return "assets";
    }

    public function users(){
        return "users";
    }
}
