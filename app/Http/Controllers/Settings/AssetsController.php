<?php

namespace App\Http\Controllers\Settings;

use Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\LAsset;
use App\LAssetType;

class AssetsController extends Controller
{
    public function assets(){

        $assets = LAsset::all();
        $types = LAssetType::all();
        return view('settings.assets.assets', compact('assets', 'types'));
    }

    public function add(){

        $asset = new LAsset;
        $types = LAssetType::all();
        return view('settings.assets.add', compact('asset', 'types'));
    }

    public function submitAsset(Request $request){

    	if(array_key_exists('id', $request->all())){
    		$asset = LAsset::find($request->id);
    	}
    	else {
        	$asset = new LAsset;
    	}

        $asset->asset = $request->asset;
        $asset->type = $request->category;
        $asset->price = $request->price;
        $asset->min_hour = $request->min_hour;
        $asset->remark = $request->remark;

        if($asset->save()){

	        alert()->success('Saved', 'Successful');
	        return redirect()->to('settings/assets');
        }
    } 

    public function edit($id){

        $asset = LAsset::find($id);
        $types = LAssetType::all();
        return view('settings.assets.edit', compact('asset', 'types'));
    }  

    public function deactivate($id){

        $asset = LAsset::find($id);

        if($asset){

        	$asset->status = 0;

	        if($asset->save()){

		        alert()->success('Deleted', 'Successful');
		        return redirect()->to('settings/assets');
	        }
	    }
    }  
}
