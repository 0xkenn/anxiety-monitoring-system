<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id';
    

    protected $fillable = [
        'school_id',
        'employee_id',
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
        'barangay',
    ];
    protected $casts = [
    'employee_id' => 'string', // Ensure it's cast as string, if needed
];




   

    public function questions()
    {
        return $this->hasMany(Question::class, 'employee_id'); 
    }
    public function school(){
       return $this->belongsTo(School::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'employee_id', 'employee_id');
    }
     public function program(){
       return $this->belongsTo(Program::class);
    }
    protected $hidden = [
        'password',
    ];
}
