<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $fillable = [
        'id',
        'fname',
        'lname',
        'address',
        'mobile',
    ];
}
