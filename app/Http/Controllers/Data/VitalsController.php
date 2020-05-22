<?php

namespace App\Http\Controllers\Data;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Vital_History;
use App\Members;
use App\Sms_Table;

class VitalsController extends Controller
{

   

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        // $vitals->user_id = $user_id;

        DB::table('vital_history')
        ->insert(
            [
            'user_id' => $user_id,
            'members_id' => request('members_id'),
            'pulse_rate' => request('pulse_rate'),
            'heart_beat' => request('heart_beat'),
            'temperature' => request('temperature'),
            'created_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)'),
            'updated_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)')
            ]
        );

        DB::table('sms_table')
        ->insert(
            [
            'user_id' => $user_id,
            'members_id' => request('members_id'),
            'pulse_rate' => request('pulse_rate'),
            'heart_beat' => request('heart_beat'),
            'temperature' => request('temperature'),
            'created_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)'),
            'updated_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)')
            ]
        );


        return 'success';

    }

    public function store2(Request $request)
    {
        $vitals = new Vital_History;

        $user_id = Auth::user()->id;
        $vitals->user_id = $user_id;

        $vitals->members_id = request('members_id');
        $vitals->pulse_rate = request('pulse_rate');
        $vitals->heart_beat = request('heart_beat');
        $vitals->temperature = request('temperature');

        $vitals->updated_at = DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)');

        $vitals->save();

        $sms = new Sms_Table;

        $sms->user_id = $user_id;

        $sms->members_id = request('members_id');
        $sms->pulse_rate = request('pulse_rate');
        $sms->heart_beat = request('heart_beat');
        $sms->temperature = request('temperature');

        $sms->save();

        return 'success';

    }


    public function getSmsInfo()
    {
        $sms = DB::table('sms_table as sms')
                        ->leftJoin('members as m', 'sms.members_id', '=', 'm.id')
                        ->select('sms.id','sms.pulse_rate','sms.heart_beat','m.contact_number','sms.temperature','m.last_name','m.first_name')
                        ->first();

        if($sms !== null ){
            
            DB::table('sms_table')->where('id', '=', $sms->id)->delete();
        }            
        return compact('sms');
        
    }
   
}
