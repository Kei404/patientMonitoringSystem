<?php

namespace App\Http\Controllers\Data;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Members;
use App\Test_Data;

class DataContoller extends Controller
{

    public function receivedata($id, $rate, $beat, $temp)
    {
        // $data = array($pulse_rate, $heart_beat, $temperature);   

        DB::table('test_data')
            ->where('user_id','=',$id)
            ->update(
                [
                'rate' => $rate,
                'beat' => $beat,
                'temp' => $temp,
                'updated_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)')
                ]
            );

        return 'success';
    }

}  
