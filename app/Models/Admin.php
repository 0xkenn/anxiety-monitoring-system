<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    protected $fillable = [
        'user_id', 'password', 'last_name', 'first_name', 'middle_name', 'birthdate', 'gender', 'mobile_number',
    ];
    use HasFactory;
}
