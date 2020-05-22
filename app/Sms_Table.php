<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms_Table extends Model
{
    protected $table = "sms_table";

    protected $fillable = [

        'id',
        'user_id',
        'members_id',
        'pulse_rate',
        'heart_beat',
        'temperature',
        
    ];
}
