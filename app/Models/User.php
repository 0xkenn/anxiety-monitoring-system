<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
     use HasFactory;

    protected $fillable = [
        'user_id',
        'password',
        'last_name',
        'first_name',
        'middle_name',
        'birthdate',
        'sex',
        'school',
        'mobile_number',
        'email',
        'province',
        'municipality',
        'barangay',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Add any additional methods or relationships to the model
    
}

