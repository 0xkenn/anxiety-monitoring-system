<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginCoordinatorRequest;
use App\Models\Assessment;
use App\Models\Coordinator;
use App\Models\Question;
use App\Models\School;
use App\Models\Student;
use App\Models\Employee;
use Auth;
use DB;
use Illuminate\Http\Request;

class GuidanceCoordinatorController extends Controller
{


    public function school(){
        $schools = School::all();
        return response()->json($schools);
    }
     public function Home(){
        
        return view ('guidance_coordinator.home');
    }
        public function dashboard(){
            $id = Auth::guard('coordinator')->id();
                //get the school id of the authenticated coordinator
            $schoolId = Coordinator::where('id', $id)->value('school_id');
           $lowAnxiety = Question::with('student') // Eager load the related 'student'
    ->where('status', 'Low') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();


      $moderateAnxiety = Question::with('student') // Eager load the related 'student'
    ->where('status', 'Moderate') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();
    $severeAnxiety = Question::with('student') // Eager load the related 'student'
    ->where('status', 'Severe') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();

      $lowAnxietye = Question::with('employee') // Eager load the related 'student'
    ->where('status', 'Low') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get(); 

      $moderateAnxietye = Question::with('employee') // Eager load the related 'student'
    ->where('status', 'Moderate') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();
    $severeAnxietye = Question::with('employee') // Eager load the related 'student'
    ->where('status', 'Severe') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();
   
            // $students = Student::where('school_id', $schoolId)->get();
          
           $studentAnxietyCounts = Question::whereHas('student', function($query) use ($schoolId) {
    $query->where('school_id', $schoolId);
})
->select('status', \DB::raw('count(*) as total')) // Count total entries per status
->groupBy('status') // Group by the status
->get();

 $employeeAnxietyCounts = Question::whereHas('employee', function($query) use ($schoolId) {
    $query->where('school_id', $schoolId);
})
->select('status', \DB::raw('count(*) as total')) // Count total entries per status
->groupBy('status') // Group by the status
->get();



// Prepare labels and data arrays

$employeeLabels = []; // Initialize labels array
$employeeData = [];
 $studentLabels = [];
  $studentData = [];   // Initialize data array

foreach($employeeAnxietyCounts as $anxieti){
    $employeeLabels[] = $anxieti->status;
    $employeeData[] = $anxieti->total;
}

foreach ($studentAnxietyCounts as $anxiety) {
    $studentLabels[] = $anxiety->status; // Anxiety status as labels
    $studentData[] = $anxiety->total; // Count as data
}
 


            return view('guidance_coordinator.dashboard' , compact('studentLabels', 'studentData', 'severeAnxiety', 'lowAnxiety', 'moderateAnxiety', 'employeeLabels', 'employeeData', 'lowAnxietye', 'severeAnxietye', 
            'moderateAnxietye'));
    }
     public function Login(){
        return view ('guidance_coordinator.login');
     }

     public function Student(){
        $id = Auth::guard('coordinator')->id();
        $schoolId = Coordinator::where('id', $id)->value('school_id');
       
        //get students with assessments and program relationsjip
        $students = Student::with('assessments', 'program')->where('school_id',$schoolId)->get();
        
    
     return view ('guidance_coordinator.student',compact('students'));
    }

     public function Employee(){
        $employees = Employee::with('questions', 'school')->get();
        return view ('guidance_coordinator.employee',compact('employees'));
    }

  
    
    public function createCounselor(){
        return view('guidance_coordinator.home');
    }
    public function loginCoordinator(LoginCoordinatorRequest $request){
       
      $data =   $request->validated();
      
        

         if(Auth::guard('coordinator')->attempt([
            'coordinator_id' =>$request->coordinator_id,
            'password' => $request->password
            ])){
         $request->session()->regenerate();
         return redirect()->route('guidance_coordinator.dashboard');
    }}

public function logout(Request $request){
     Auth::guard('coordinator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
}

public function studentData(){

       $id = Auth::guard('coordinator')->id();
                //get the school id of the authenticated coordinator
            $schoolId = Coordinator::where('id', $id)->value('school_id');
           $lowAnxiety = Question::with('student') // Eager load the related 'student'
    ->where('status', 'Low') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();


      $moderateAnxiety = Question::with('student') // Eager load the related 'student'
    ->where('status', 'Moderate') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();
    $severeAnxiety = Question::with('student') // Eager load the related 'student'
    ->where('status', 'Severe') // Filter for low anxiety assessments
    ->whereHas('student', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the student's school ID matches the coordinator's
    })
    ->get();

    $studentLabels = [];
  $studentData = []; 

  $studentAnxietyCounts = Question::whereHas('student', function($query) use ($schoolId) {
    $query->where('school_id', $schoolId);
})
->select('status', DB::raw('count(*) as total')) // Count total entries per status
->groupBy('status') // Group by the status
->get();
  foreach ($studentAnxietyCounts as $anxiety) {
    $studentLabels[] = $anxiety->status; // Anxiety status as labels
    $studentData[] = $anxiety->total; // Count as data
}
// Assuming you have the authenticated coordinator's school ID
$schoolId = auth()->user()->school_id; // Get the authenticated coordinator's school ID

$highestAnxieties = Question::select('student_id', 'status', DB::raw('count(*) as total'))
    ->whereHas('student', function ($query) use ($schoolId) {
        $query->where('school_id', $schoolId);
    })
    ->groupBy('student_id', 'status')
    ->orderBy('total', 'desc')
    ->get();

$studentsHighestStatus = [];

foreach ($highestAnxieties as $anxiety) {
    $studentsHighestStatus[$anxiety->student_id] = $anxiety->status;
}
$statusCounts = array_count_values($studentsHighestStatus);

// Get the status with the highest occurrence
$highestStatus = array_search(max($statusCounts), $statusCounts);
// Filter students to only include those with the highest anxiety status
$filteredStudents = array_filter($studentsHighestStatus, function ($status) use ($highestStatus) {
    return $status == $highestStatus;
});

$programData = [];

foreach ($filteredStudents as $studentId => $status) {
    $student = Student::find($studentId);

    // Ensure the student belongs to the coordinator's school and has a program
    if ($student->school_id == $schoolId && $student->program) {
        $programId = $student->program_id;

        // Add or update the program count
        if (!isset($programData[$programId])) {
            $programData[$programId] = [
                'program' => $student->program->program_name, // safely access program_name
                'count' => 1
            ];
        } else {
            $programData[$programId]['count']++;
        }
    }
}



   
    return view('guidance_coordinator.student_data', compact('lowAnxiety', 'moderateAnxiety' , 'severeAnxiety', 'studentLabels', 'studentData', 'programData'));
}
public function employeeData(){
     $id = Auth::guard('coordinator')->id();
                //get the school id of the authenticated coordinator
     $schoolId = Coordinator::where('id', $id)->value('school_id');

     $lowAnxietye = Question::with('employee') // Eager load the related 'emp'
    ->where('status', 'Low') // Filter for low anxiety assessments
    ->whereHas('employee', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the emp's school ID matches the coordinator's
    })
    ->get(); 
    

      $moderateAnxietye = Question::with('employee') // Eager load the related 'emp'
    ->where('status', 'Moderate') // Filter for low anxiety assessments
    ->whereHas('employee', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the emp's school ID matches the coordinator's
    })
    ->get();
    
    $severeAnxietye = Question::with('employee') // Eager load the related 'emp'
    ->where('status', 'Severe') // Filter for low anxiety assessments
    ->whereHas('employee', function($query) use ($schoolId) {
        $query->where('school_id', $schoolId); // Ensure the emp's school ID matches the coordinator's
    })
    ->get();

     $employeeAnxietyCounts = Question::whereHas('employee', function($query) use ($schoolId) {
    $query->where('school_id', $schoolId);
})
->select('status', \DB::raw('count(*) as total')) // Count total entries per status
->groupBy('status') // Group by the status
->get();


$employeeLabels = []; // Initialize labels array
$employeeData = [];


foreach($employeeAnxietyCounts as $anxieti){
    $employeeLabels[] = $anxieti->status;
    $employeeData[] = $anxieti->total;
}
$schoolId = auth()->user()->school_id; // Get the authenticated coordinator's school ID

// Fetch the highest anxiety statuses for employees
$highestAnxieties = Question::select('employee_id', 'status', DB::raw('count(*) as total'))
    ->whereHas('employee', function ($query) use ($schoolId) {
        $query->where('school_id', $schoolId);
    })
    ->groupBy('employee_id', 'status')
    ->orderBy('total', 'desc')
    ->get();

$employeesHighestStatus = [];

// Map employee IDs to their highest anxiety status
foreach ($highestAnxieties as $anxiety) {
    $employeesHighestStatus[$anxiety->employee_id] = $anxiety->status;
}

$statusCounts = array_count_values($employeesHighestStatus);

// Get the status with the highest occurrence
$highestStatus = array_search(max($statusCounts), $statusCounts);

// Filter employees to only include those with the highest anxiety status
$filteredEmployees = array_filter($employeesHighestStatus, function ($status) use ($highestStatus) {
    return $status == $highestStatus;
});

$programData = [];

// Loop through filtered employees and aggregate their program data
foreach ($filteredEmployees as $employeeId => $status) {
    $employee = Employee::find($employeeId);

    // Ensure the employee belongs to the coordinator's school and has a program
    if ($employee && $employee->school_id == $schoolId && $employee->program) {
        $programId = $employee->program_id;

        // Add or update the program count
        if (!isset($programData[$programId])) {
            $programData[$programId] = [
                'program' => $employee->program->program_name, // safely access program_name
                'count' => 1
            ];
        } else {
            $programData[$programId]['count']++;
        }
    }
}

// Optionally return or pass $programData to your view or further processing

    
    return view('guidance_coordinator.employee_data', compact('lowAnxietye', 'moderateAnxietye', 'severeAnxietye', 'employeeLabels', 'employeeData', 'programData'));
}
}