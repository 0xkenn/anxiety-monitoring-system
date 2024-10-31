<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'assessment_id', 'date', 'score', 'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
    public function employee()
    {
        return $this->belongTo(Employee::class, 'employee_id', 'employee_id');
    }

public function assessment()
{
    return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
}

    
}
