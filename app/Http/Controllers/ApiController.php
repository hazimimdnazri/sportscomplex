<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Customer as CustomerResource;
use App\CustomerDetail;
use App\LSport;

class ApiController extends Controller
{
    public function customers(){
        $customers = Customer::all();
        return CustomerResource::collection($customers);
    }

    public function customer($id){
        $customers = CustomerDetail::where('ic', $id)->first();
        if($customers){
            return new CustomerResource($customers);
        } else {
            return "error";
        }
        
    }

    public function asset($id){
        $asset = LSport::find($id);
        return view('shared.duration', compact('asset'));
    }
}
