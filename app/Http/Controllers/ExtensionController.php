<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\extension;
use App\Models\updates;

class ExtensionController extends Controller
{

    public function extensions(){
        $extensions = extension::all();
        return view('ExtensionList',compact('extensions'));
    }

    public function addExtension(Request $req){
        $req->validate([
            'name'=>'required|max:255',
            'demo_link'=>'nullable',
            'admin_username'=>'required',
            'admin_password' => 'required',
            'marketplace_link' => 'nullable',
        ]);
        
        $data = new extension;

        $data->name = $req->name;

        if(isset($req->demo_link)){
            $data->demo_link = $req->demo_link;
        }else{
            $data->demo_link = 'null';
        }

        $data->admin_username = $req->admin_username;
        $data->admin_password = $req->admin_password;

        if(isset($req->marketplace_link)){
            $data->marketplace_link = $req->marketplace_link;
        }else{
            $data->marketplace_link = 'null';
        }

        $data->demo = $req->demo;

        $save = $data->save();

        if($save == 1){
            return redirect('/')->with('success','New Extension has been successfully added. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }
    }

    public function searchExtension(Request $req){
        $query = extension::query();
        $query->where('name','like', $req->search.'%' );
        $extensions = $query->get();
        $search = $req->search;
        return view('ExtensionList',compact('extensions','search'));
        
    }

    public function deleteExtension($id){
        $data = extension::find($id);
        
        $delete = $data->delete();
        
        if($delete == 1){
            return redirect('/')->with('success','Extension has been successfully Deleted. ');
        }else{
            return redirect('/')->with('fail','Something went wrong.');
        }
    }

    public function getExtension($id){
        $extension = extension::find($id);

        return view('ExtensionEdit',compact('extension'));
    }

    public function updateExtension(Request $req){

        $req->validate([
            'name'=>'required|max:255',
            'demo_link'=>'nullable',
            'admin_username'=>'required',
            'admin_password' => 'required',
            'marketplace_link' => 'nullable',
        ]);

        $data = extension::find($req->id);
        
        $data->name = $req->name;

        if(isset($req->demo_link)){
            $data->demo_link = $req->demo_link;
        }else{
            $data->demo_link = 'null';
        }

        $data->admin_username = $req->admin_username;
        $data->admin_password = $req->admin_password;

        if(isset($req->marketplace_link)){
            $data->marketplace_link = $req->marketplace_link;
        }else{
            $data->marketplace_link = 'null';
        }

        $data->demo = $req->demo;
        $save = $data->save();

        if($save == 1){
            return redirect('/')->with('success','Product has been successfully update. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }

    }

    public function filterExtension(Request $req){
        $query = extension::query();
        if(isset($req->name)){
            $query->where('name','like',$req->name.'%');
        }
        if(isset($req->demo_link)){
            $query->where('demo_link','like',$req->demo_link.'%');
        }
        if(isset($req->marketplace_link)){
            $query->where('marketplace_link','like',$req->sku.'%');
        }
        if(isset($req->demo)){
            $query->where('demo',$req->demo);
        }
        $extensions = $query->get();
        $old_data = [
            'name' => $req->name,
            'demo_link' => $req->demo_link,
            'marketplace_link' => $req->marketplace_link,
            'demo' => $req->demo,
        ];
        return view('ExtensionList',compact('extensions','old_data'));
        
    }

    public function viewUpdates($id){
        $updates = extension::find($id)->getUpdates;
        
        $extension_id = $id;

        return view('ViewUpdates',compact('extension_id','updates'));
    }

    public function extensionUpdate(Request $req){
        
        $req->validate([
            'description'=>'required|max:255',
        ]);
        
        $data = new updates;

        $data->extension_id = $req->extension_id;
        $data->description = $req->description;
        $data->marketplace_update = $req->marketplace_update;

        $save = $data->save();

        if($save == 1){
            return back()->with('success','Extension Updates has been successfully added. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }
    }

    public function deleteUpdates($id){
        $data = updates::find($id);
        
        $delete = $data->delete();
        
        if($delete == 1){
            return back()->with('success','Extension Update has been successfully Deleted. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }
    }
}
