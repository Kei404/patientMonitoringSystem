<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Vitals_History;
use App\Members;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(Request $request)
    {
        
        $user_id = Auth::user()->id;
        
        $data = DB::table('vital_history as v')
                    ->join('members as m', 'm.id', '=', 'v.members_id')
                    ->select('v.*','m.id','m.photo','m.last_name','m.first_name','m.name_extension','m.middle_name')
                    ->where('v.user_id','=',$user_id) 
                    ->where(DB::RAW('DATE(v.created_at)'),'=',DB::RAW('Date(NOW())')) 
                    ->latest()
                    ->get();

        // return $data;
        // return compact('patients','vitals');
         return view('admin.dashboard', compact('data'));                

    }

}
