<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Customer as CustomerResource;
use App\Customer;
use App\LFacility;

class ApiController extends Controller
{
    public function customers(){
        $customers = Customer::all();
        return CustomerResource::collection($customers);
    }

    public function customer($id){
        $customers = Customer::find($id);
        return new CustomerResource($customers);
    }

    public function asset($id){
        $asset = LFacility::find($id);
        return view('shared.duration', compact('asset'));
    }
}
