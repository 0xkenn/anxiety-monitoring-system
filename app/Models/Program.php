<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
                            
                            'school_id',
                            'program_name',
                             'abbrev'
                             ];

    // A program belongs to a school
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function students()
{
    return $this->hasMany(Student::class, 'program_id');
}
public function employees()
{
    return $this->hasMany(Employee::class, 'program_id');
}

}

