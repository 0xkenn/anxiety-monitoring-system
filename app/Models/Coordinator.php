<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Coordinator extends User
{
    use HasFactory;

        protected $fillable = [
                'school_id',
                'coordinator_id',
                 'last_name',
                 'first_name',
                     'middle_name',
                    'sex', 
                    'password',
                    'mobile_number'
                ];

       public function school(){
      return  $this->belongsTo(School::class);
       }         
}
