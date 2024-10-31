<?php
namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\History;
use App\Models\Question;
use Auth;
use Illuminate\Http\Request;
use App\Models\Student;

class HistoryController extends Controller
{

    public function studentHistory(){
        $id = Auth::guard('student')->id();
        
        $histories = Question::with('student')->where('student_id', $id)->get();
   
        return view('student.history', compact('histories'));
    }

        public function employeeHistory(){
         $id = Auth::guard('employee')->id();
        $histories = Question::with('employee')->where('employee_id', $id)->get();
       return view('employee.history', compact('histories'));
    }





}
