<?php

namespace App\Http\Controllers\Settings;

use Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\LAssetType;

class CategoriesController extends Controller
{
    public function categories(){
        $categories = LAssetType::all();
        return view('settings.categories.categories', compact('categories'));
    }

    public function add(){
        $category = new LAssetType;
        return view('settings.categories.add', compact('category'));
    }

    public function submitCategory(Request $request){

    	if(array_key_exists('id', $request->all())){
    		$asset = LAssetType::find($request->id);
    	}
    	else {
        	$asset = new LAssetType;
    	}

        $asset->type = $request->asset;
        $asset->status = 1;

        if($asset->save()){

	        alert()->success('Saved', 'Successful');
	        return redirect()->to('settings/categories');
        }
    }

    public function edit($id){

        $category = LAssetType::find($id);
        return view('settings.categories.edit', compact('category'));
    }  

    public function deactivate($id){

        $asset = LAssetType::find($id);

        if($asset){

        	$asset->status = 0;

	        if($asset->save()){

		        alert()->success('Deactivated', 'Successful');
		        return redirect()->to('settings/categories');
	        }
	    }
    }  
}
