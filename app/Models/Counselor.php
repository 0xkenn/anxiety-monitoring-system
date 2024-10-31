<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Counselor extends User
{
    use HasFactory;

             
        protected $fillable = [
                'school_id',
                'counselor_id',
                 'last_name',
                 'first_name',
                  'middle_name',
                  'sex', 
                  'password',
                   'mobile_number',
                  'email',
                  
                ];
                public function school(){
                    return $this->belongsTo(School::class);
                }
}
