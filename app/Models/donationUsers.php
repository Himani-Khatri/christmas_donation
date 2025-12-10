<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class donationUsers extends Model
{
    protected $table='donation_users';
    protected $fillable=[
        'fname',
        'phone',
        'email',
        'date',
        'password',
        'gender',

    ];
}
