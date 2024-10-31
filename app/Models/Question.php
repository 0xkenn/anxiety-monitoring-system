<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'student_id',
        'q0',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
        'q10',
        'q11',
        'q12',
        'q13',
        'q14',
        'q15',
        'q16',
        'q17',
        'q18',
        'q19',
        'q20',
        'score',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id'); 
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id'); 
    }
}
