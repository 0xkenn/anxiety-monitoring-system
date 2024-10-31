<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginCounselorRequest;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\Student;
use App\Models\Employee;
use Auth;
use Illuminate\Http\Request;

class GuidanceCounselorController extends Controller
{
    //
    public function Dashboard($type = 'student')
    {
        $chartType = $type;
        $lowStudent = Question::where('status', 'Low')->whereNotNull('student_id')->count();
        $moderateStudent = Question::where('status', 'Moderate')->whereNotNull('student_id')->count();
        $severeStudent = Question::where('status', 'Severe')->whereNotNull('student_id')->count();


        return view('guidance_counselor.dashboard', compact('chartType', 'lowStudent', 'moderateStudent', 'severeStudent')); // Pass the variable to the view
    }
    public function Login()
    {
        return view ('guidance_counselor.login');
    }
   
     public function Home()
     {
        return view ('guidance_counselor.home');
    }
    public function Student()
    { 
   
     $students = Student::with('assessments', 'school')->get();
    
   
      
        return view ('guidance_counselor.student',compact('students'));
    }
    public function getStudentScores($id)
    {
        // Find the student by ID and load related questions with scores and statuses
        $student = Student::with('questions')->find($id);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        // Extract scores and statuses from the questions
        $data = $student->questions->map(function ($question) {
            return [
                'score' => $question->score,
                'status' => $question->status,
            ];
        });

        return response()->json($data);
    }
    
        public function Employee()
        {
            $employees =Employee::with('questions', 'school')->get();

        return view ('guidance_counselor.employee',compact('employees'));
    }
     public function AddCoordinator()
        {
        return view ('guidance_counselor.addCoordinator');
    }
        public function Aboutus()
        {
        return view ('guidance_counselor.about_us');
    }
    public function loginCounselor(LoginCounselorRequest $request){
       
      $data =   $request->validated();


         if(Auth::guard('counselor')->attempt([
            'counselor_id' =>$request->counselor_id,
            'password' => $request->password
            ])){
                
         $request->session()->regenerate();
         return redirect()->route('counselor.dashboard');
    }}

}
