<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use App\Members;
use App\Vital_History;
use Illuminate\Support\Facades\Auth;


class CreateController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin/create');
    }
    
    public function store(Request $request)
    {
        $photo = "image_icon";
        
        if($request->file('photo')){
            $photo = Str::random(25);
            $cover = $request->file('photo');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put( $photo.'.png',  File::get($cover));
        }

        $pnts = new Members;
        $user_id=Auth::user()->id;
        $pnts->photo = $photo.'.png';
        $pnts->user_id = $user_id;
        $pnts->last_name = $request->input('last_name');
        $pnts->first_name = $request->input('first_name');
        $pnts->name_extension = $request->input('name_extension');
        $pnts->middle_name = $request->input('middle_name');
        $pnts->email_address = $request->input('email_address');
        $pnts->contact_number = $request->input('contact_number');
        $pnts->dob = $request->input('dob');
        $pnts->gender = $request->input('gender');
        $pnts->guardian = $request->input('guardian');
        $pnts->address1 = $request->input('address1');
        $pnts->address2 = $request->input('address2');
        $pnts->barangay = $request->input('barangay');
        $pnts->municipality = $request->input('municipality');
        $pnts->province = $request->input('province');
        $pnts->zipcode = $request->input('zipcode');

        $pnts->save();

        return 'success';
    }

    public function edit($id)
    {
        $patients = DB::table('members')
                        ->select('*')
                        ->where('id','=',$id)
                        ->first();
       
        return view('admin.edit', compact('patients'));
    }

    public function update(Request $request)
    { 
        if($request->current_image == "true"){
            $photo = $request->photo_name;
        }else{
            
        $photo = "image_icon";
        if($request->photo_name != "image_icon.png"){
        $photo = str_replace(".png","",$request->photo_name);
        }

        if($request->file('photo')){
            if($request->photo_name != "image_icon.png"){
                    if(Storage::disk('public')->exists($request->photo_name)){
                    Storage::disk('public')->delete($request->photo_name);
                    }else{
                    // dd('File does not exists.');
                    }
            }

        $photo = Str::random(25).'.png';
        $cover = $request->file('photo');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put( $photo,  File::get($cover));
            }
        }   

        DB::table('members')
        ->where('id','=',$request->id)
        ->update(
            [
            'photo' =>  $photo,
            'last_name' => $request->last_name ,
            'first_name' => $request->first_name ,
            'name_extension' => $request->name_extension ,
            'middle_name' => $request->middle_name ,
            'email_address' => $request->email_address ,
            'guardian' => $request->guardian,
            'contact_number' => $request->contact_number == "null"? "":$request->contact_number,
            'dob' => $request->dob == "null"? null:$request->dob,
            'gender' => $request->gender,
            'address1' => $request->address1 == "null"? "":$request->address1,
            'address2' => $request->address2 == "null"? "":$request->address2,
            'barangay' => $request->barangay == "null"? "":$request->barangay,
            'municipality' => $request->municipality == "null"? "":$request->municipality,
            'province' => $request->province == "null"? "":$request->province,
            'zipcode' => $request->zipcode == "null"? "":$request->zipcode
            ]
        );

        
        return 'success';
        // return redirect()->back()->with('id','=',$request->id);
        // return redirect('/patient/profile/','+',$request->id)->with('success', 'Data Updated');
    }

    public function registered()
    {
        $user_id = Auth::user()->id;
        // $patients = Members::where('user_id', '=', $user_id)->get();
        $patients = Members::get();
        
        return view('admin/list')->with('patients',$patients);
    }

    public function profile($id)
    {   
        $patients = DB::table('members')
                        ->select('*')
                        ->where('id','=',$id)
                        ->first();

        // $vitals = DB::table('vital_history as V')
        //                  ->select('*')
        //                 ->where('members_id','=',$id)
        //                 ->orderByRaw('V.updated_at desc')
        //                 ->get();
        
        return view('admin/profile', compact('patients'));
        // return compact('patients');
    }

    public function apivitals()
    {
        $patients = DB::table('test_data')
                        ->select('*')
                        // ->where('id','=',$id)
                        ->first(); 
        
        return compact('patients');   
    }

    public function destroy(request $patients)
    {
        $delete = Members::find($patients->patient_id);
        $delete->delete();

        return redirect('/patient/list')->with('success', 'Data Deleted');
    }

    public function refreshHistory($id)
    {
        $vitals = DB::table('vital_history')
                    ->select('*')
                    ->where('members_id','=',$id)
                    ->orderByRaw('updated_at desc')
                    ->get();

        return compact('vitals');
    }

    public function destroyHistory(request $request)
    {
        
        $delete = Vital_History::find($request->history_id);
        $delete->delete();

        return back();
        // return view('/patient/profile/'+$id, compact('patients'));

        // return redirect('/patient/list')->with('success', 'Data Deleted');

    }


}