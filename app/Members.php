<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $fillable = [

        'photo',
        'user_id',
        'last_name',
        'first_name',
        'name_extension',
        'middle_name',
        'email_address',
        'dob',
        'gender',
        'guardian',
        'contact_number',
        'address1',
        'address2',
        'barangay',
        'municipality',
        'province',
        'zipcode',
    
        'testdata_id',
        'vitalhistory_id',
    ];
}
