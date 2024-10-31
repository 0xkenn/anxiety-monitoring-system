<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Student extends User
{
    use HasFactory;

    protected $primaryKey = 'student_id';

    protected $fillable = [   
                'school_id',
                'program_id',
                'user_id', 
                'password', 
                'last_name', 
                'first_name',
                'middle_name',
                'birthdate',
                'sex', 
                'mobile_number', 
                'email',
                'province', 
                'municipality', 
                'barangay'
    ];

     public function assessments()
    {
        return $this->hasMany(Assessment::class, 'student_id'); 
    }

     public function questions()
    {
        return $this->hasMany(Question::class, 'student_id'); 
    }
      public function school(){
       return $this->belongsTo(School::class);
    }
    
      public function program(){
       return $this->belongsTo(Program::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'student_id', 'student_id');
    }

  
    
}
