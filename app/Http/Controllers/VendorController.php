<?php

namespace App\Http\Controllers;
use App\Models\Vendors;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
        $data=Vendors::all();
        return view('add_vendor',compact('data'));
    }

    public function set_vendor(Request $request){

        $data['vendor_name']=$request['vendor_name'];
        $data['address']=$request['address'];
        $data['contact_number']=$request['contact_no'];
        $data['status']='active';
        $save=Vendors::create($data);
        session()->flash('message', 'Data Add Successfully!');
        session()->flash('alert-class', 'alert-success');
        return back()->with(['status' =>  'success']);
    }

    public function edit_vendor(Request $request){

        $id=$request->id;
        $data=Vendors::where(['id'=>$id])->first()->toArray();
        return view('edit_vendor',compact('data'));
    }

    public function update_vendor(Request $request){

        $data['vendor_name']=$request['vendor_name'];
        $data['address']=$request['address'];
        $data['contact_number']=$request['contact_no'];
        $data['status']=$request['status'];
        $create=Vendors::Where('id',$request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!');
        session()->flash('alert-class', 'alert-success');
        return Redirect::to('/vendors')->with(['status' =>  'success']);
    }
}

