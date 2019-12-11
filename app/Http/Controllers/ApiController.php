<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Customer as CustomerResource;
use App\Customer;
use App\LAsset;

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
        $asset = LAsset::find($id);
        return view('shared.duration', compact('asset'));
    }
}
