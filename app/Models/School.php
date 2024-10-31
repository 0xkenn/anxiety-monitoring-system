<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['school_name', 'abbrev'];

    // A school has many programs
    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function coordinator(){
        return $this->hasOne(Coordinator::class);
    }

    public function counselor(){
        return $this->hasOne(Counselor::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
}
