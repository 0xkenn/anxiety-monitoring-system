<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'employee_id', 'score', 'status', 'assessment_date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id'); 
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id'); 
    }
}


