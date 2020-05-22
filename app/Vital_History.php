<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vital_History extends Model
{
    protected $table = "vital_history";

    protected $fillable = [

        'id',
        'user_id',
        'members_id',
        'pulse_rate',
        'heart_beat',
        'temperature',
        'updated_at'
        
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];
}
