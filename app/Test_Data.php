<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_Data extends Model
{
    protected $table = "test_data";

    protected $fillable = [

        'id',
        'user_id',
        'members_id',
        'rate',
        'beat',
        'temp',
        
    ];
}
