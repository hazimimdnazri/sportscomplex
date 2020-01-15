<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\LActivity;

class ActivitiesController extends Controller
{
    
    public function activities(){

        $activities = LActivity::all();
        return view('settings.activities.activities', compact('activities'));
    }

    public function submitActivity(Request $request){

    	if(array_key_exists('id', $request->all())){
    		$activity = LActivity::find($request->id);
    	}
    	else {
        	$activity = new LActivity;
    	}

        $activity->activity = $request->activity;
        $activity->public = $request->public;
        $activity->students = $request->students;
        $activity->underage = $request->underage;
        $activity->deposit = $request->deposit;
        $activity->remark = $request->remark;
        $activity->created_by = Auth()->user()->id;

        if($activity->save()){

	        alert()->success('Saved', 'Successful');
	        return redirect()->to('settings/activities');
        }
    }

    public function add(){

        $activity = new LActivity;
        return view('settings.activities.add', compact('activity'));
    }

    public function edit($id){

        $activity = LActivity::find($id);
        return view('settings.activities.edit', compact('activity'));
    }  

    public function deactivate($id){

        $activity = LActivity::find($id);

        if($activity){

        	$activity->status = 0;

	        if($activity->save()){

		        alert()->success('Deactivated', 'Successful');
		        return redirect()->to('settings/activities');
	        }
	    }
    }  
}
