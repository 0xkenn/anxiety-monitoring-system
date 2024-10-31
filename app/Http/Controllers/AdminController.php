<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSchoolRequest;
use App\Http\Requests\CoordinatorRequest;
use App\Http\Requests\CounselorRequest;
use App\Http\Requests\CreateProgramRequest;
use App\Http\Requests\EditCounselorRequest;
use App\Http\Requests\UpdateCoordinatorRequest;
use App\Models\Coordinator;
use App\Models\Counselor;
use App\Models\Program;
use App\Models\School;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Assessment;
use App\Models\Question;

use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showCoordinator(){

        $coordinators = Coordinator::all();
         $schools = School::all();
         
        return view('admin.coordinator.index', compact('coordinators', 'schools'));
    }

   
    
     public function AddCoordinator(CoordinatorRequest $request){
            $data =  $request->validated();
            $data['password'] = Hash::make( $data['password']);
             
             Coordinator::create($data);
        return redirect()->route('show.coordinator');
    }
    public function authLogin(Request $request){

        $request->validate([
        'user_id' => 'required|max:30',  // Ensure user_id is present and is a valid string
        'password' => 'required|string',         // Ensure password is present and is a string
    ]);
    

        if(Auth::guard('admin')->attempt(['user_id' =>$request->user_id,'password' => $request->password])){
         $request->session()->regenerate();
         return redirect()->route('admin.dashboard');
        }else {
    // Failed login (for testing)
    dd('Login failed, please check your credentials');
}
    }

    //
    public function Dashboard(){
        return view ('admin.home');
    }
    public function Login(){
        return view ('admin.login');
    }
    public function adminRegister(){
        return view ('admin.register');
    }
     public function Home($type = 'student'){
           $chartType = $type; // Set the chart type based on the route parameter
        $lowStudent = Question::where('status', 'Low')->whereNotNull('student_id')->count();
       
        $moderateStudent = Question::where('status', 'Moderate')->whereNotNull('student_id')->count();
        $severeStudent = Question::where('status', 'Severe')->whereNotNull('student_id')->count();
         $lowEmployee = Question::where('status', 'Low')->whereNotNull('employee_id')->count();
        
        $moderateEmployee = Question::where('status', 'Moderate')->whereNotNull('employee_id')->count();
       
        $severeEmployee = Question::where('status', 'Severe')->whereNotNull('employee_id')->count();
        $totalStudents = $lowStudent + $moderateStudent + $severeStudent;
        $totalEmployees = $lowEmployee + $moderateEmployee + $severeEmployee;

    //    $schoolIds = Question::with('student') // Load the associated students
    // ->join('students', 'questions.student_id', '=', 'students.student_id') // Join the students table
    // ->distinct() // Get distinct school_ids
    // ->pluck('students.school_id');
    // $schoolNames = Question::join('students', 'questions.student_id', '=', 'students.student_id') // Join the students table
    // ->join('schools', 'students.school_id', '=', 'schools.id') // Join the schools table
    // ->distinct() // Get distinct school_ids
    // ->pluck('schools.abbrev', 'schools.id');
    $lowAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Low') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
      
        
        $moderateAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Moderate') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
       


        $severeAnxietyCounts = Question::join('students', 'questions.student_id', '=', 'students.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.abbrev', DB::raw('COUNT(questions.student_id) as student_count'))
        ->where('questions.status', 'Severe') // Filter for low anxiety status
        ->groupBy('schools.abbrev') // Group by school abbreviation
        ->get(); // Execute the query
        
 $combinedCounts = [];
    
    // Prepare combined counts for each anxiety status
    foreach ($lowAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Low'] = $count->student_count;
    }

    foreach ($moderateAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Moderate'] = $count->student_count;
    }

    foreach ($severeAnxietyCounts as $count) {
        $combinedCounts[$count->abbrev]['Severe'] = $count->student_count;
    }
   
        
        // $school = Question::with('student')->where('school_id', )

      $studentData = [
    'labels' => ['Severe', 'Moderate', 'Low'],
    'datasets' => [
        [
            'label' => 'Students',
            'data' => [
                ($totalStudents > 0) ? round(($lowStudent / $totalStudents) * 100, 2) : 0,
                ($totalStudents > 0) ? round(($moderateStudent / $totalStudents) * 100, 2) : 0,
                ($totalStudents > 0) ? round(($severeStudent / $totalStudents) * 100, 2) : 0,
            ],
            'backgroundColor' => [
                'rgba(255, 0, 0, 0.6)',    // Red for "Low"
                'rgba(255, 215, 0, 0.6)',  // Gold for "Moderate"
                'rgba(0, 128, 0, 0.6)'     // Green for "Severe"
            ],
        ],
    ],
];


$employeeData = [
    'labels' => ['Low', 'Moderate', 'Severe'],
    'datasets' => [
        [
            'label' => 'Employees',
            'data' => [$lowEmployee, $moderateEmployee, $severeEmployee],
            'backgroundColor' => [
                 // Red for "s"
                  'rgba(0, 128, 0, 0.6)' ,
                'rgba(255, 215, 0, 0.6)',  // Gold for "Moderate"
                 
                 'rgba(255, 0, 0, 0.6)',    // Green for "l"

            ], // Example color for employees
        ],
    ],
];
switch(true) {
    case ($lowEmployee >= $moderateEmployee && $lowEmployee >= $severeEmployee):
        $highestStatusE = 'Low';
        break;
    case ($moderateEmployee >= $lowEmployee && $moderateEmployee >= $severeEmployee):
        $highestStatusE = 'Moderate';
        break;
    case ($severeEmployee >= $lowEmployee && $severeEmployee >= $moderateEmployee):
        $highestStatusE = 'Severe';
        break;
}
switch(true) {
    case ($lowStudent >= $moderateStudent && $lowStudent >= $severeStudent):
        $highestStatus = 'Low';
        break;
    case ($moderateStudent >= $lowStudent && $moderateStudent >= $severeStudent):
        $highestStatus = 'Moderate';
        break;
    case ($severeStudent >= $lowStudent && $severeStudent >= $moderateStudent):
        $highestStatus = 'Severe';
        break;
}

$subQuery = DB::table('questions as a')
    ->join('students as st', 'a.student_id', '=', 'st.student_id')
    ->join('schools as s', 'st.school_id', '=', 's.id')
    ->select(
        's.abbrev',
        DB::raw('COUNT(a.student_id) as moderate_count')
    )
    ->where('a.status', '=', $highestStatus)  // Filter by Moderate status
    ->groupBy('s.abbrev')
    ->orderBy('moderate_count', 'DESC');  // Sort by the count in descending order

// Get the data
$data = $subQuery->get();

// Transform the data for Chart.js format
$chartData = [
    'labels' => [],
    'datasets' => [
        [
            'label' => 'highest Assessment Status',
            'data' => []
        ]
    ]
];

foreach ($data as $row) {
    $chartData['labels'][] = $row->abbrev;
    $chartData['datasets'][0]['data'][] = $row->moderate_count;
}
$eSubQuery = DB::table('questions as a')
    ->join('employees as st', 'a.employee_id', '=', 'st.id')
    ->join('schools as s', 'st.school_id', '=', 's.id')
    ->select(
        's.abbrev',
        DB::raw('COUNT(a.employee_id) as moderate_count ')
    )
    ->where('a.status', '=', $highestStatusE)  // Filter by Moderate status
    ->groupBy('s.abbrev')
    ->orderBy('moderate_count', 'DESC');  // Sort by the count in descending order

// Get the data
$empData = $eSubQuery->get();

// Transform the data for Chart.js format
$empChartData = [
    'labels' => [],
    'datasets' => [
        [
            'label' => 'highest Assessment Status',
            'data' => []
        ]
    ]
];

foreach ($empData as $row) {
    $empChartData['labels'][] = $row->abbrev;
    $empChartData['datasets'][0]['data'][] = $row->moderate_count;
}
        return view ('admin.home', compact('chartType', 'lowStudent', 'moderateStudent', 'severeStudent', 'lowEmployee', 'moderateEmployee', 'severeEmployee', 'studentData', 'employeeData', 'chartData', 'empChartData'));
    }
    public function Users(){
        return view ('admin.users');
    }

        public function Verification(){
        return view ('admin.verify');
    }

            public function Program(){
        return view ('admin.program');
    }

        public function School(){
            $schools = School::all();
        return view ('admin.school', compact('schools'));
    }

    public function AddSchool(CreateSchoolRequest $request)
{
   
    // Validate the request data
    $data = $request->validated();


    // Check if the school name already exists
    $existingSchool = School::where('school_name', $data['school_name'])->first();
    if ($existingSchool) {
        // Redirect back with an error message if the school already exists
        return redirect()->back()->with('message', 'This school name already exists in the database.');
    }

    // If no existing school is found, create the new school
    School::create($data);

    // Retrieve all schools for display
    $schools = School::all();

    // Return to the view with the list of schools
    return view('admin.school', compact('schools'))->with('success', 'School added successfully!');
}
    public function editCoordinator($id){
        $schools = School::all();
            $coordinator = Coordinator::where('id', $id)->get();
            
        return view('admin.coordinator.edit', compact('coordinator', 'schools'));
    }

    public function deleteCoordinator($id){

        Coordinator::destroy($id);
        return redirect()->back();
    }

    public function update(UpdateCoordinatorRequest $request, Coordinator $coordinator){
        $data = $request->validated();
        $coordinator->update($data);

return redirect()->route('show.coordinator');
    }

    public function createCoordinator(){
        $schools = School::all();
        return view('admin.coordinator.create', compact('schools'));
    }
    public function studentIndex(){
        $students = Student::all();
        return view('admin.student.index', compact('students'));
    }
    public function deleteStudent($id){
        $student = Student::find($id);
        $student->delete();
        return redirect()->back();
    }
    
    public function employeeIndex(){
        $employees = Employee::all();
        return view('admin.employee.index', compact('employees'));
    }
      public function deleteEmployee($id){
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->back();
    }
    public function showProgram(){
            $schools = School::all();
            $programs = Program::all();
        return view('admin.program', compact('schools', 'programs'));
    }
    public function createProgram(CreateProgramRequest $request){
        $data = $request->validated();
      
        Program::create($data);
        return redirect()->route('admin.program');

    }
    public function editProgram($id){
      
        $program = Program::find($id);
        
        return view('admin.program.edit', compact('program'));
    }
    public function deleteProgram($id){
        $program = Program::find($id);
        $program->delete();
        return redirect()->back();
    }
    public function editProgramAuth(Request $request, Program $program, $id){
        $program = Program::find($id);
       $data = $request->validate(['program_name' => 'string']);
     
       $program->update($data);
        

        return redirect()->route('admin.program');
    }
    public function showCounselor(){
       $counselors = Counselor::all();
       return view('admin.counselor.index', compact('counselors'));
   }

    public function showCreateCounselor(){
        $schools = School::all();
        
        return view('admin.counselor.create', compact('schools'));
    }
    public function addCounselor(CounselorRequest $request){
       $data= $request->validated();
         $data['password'] = Hash::make( $data['password']);
       Counselor::create($data);

        return redirect()->route('counselor.show');
    }

    public function editcounselor($id){
       $counselor = Counselor::find($id);
        $schools = School::all();
       
      return view('admin.counselor.edit', compact('schools', 'counselor'));
    }
     public function deletecounselor($id){
        $counselor = Counselor::find($id);
        $counselor->delete();
        return redirect()->back();
    }
       public function editCounselorAuth(EditCounselorRequest $request, Counselor $counselor, $id){
        $counselor = Counselor::find($id);
        $data = $request->validated();
        $counselor->update($data);
    }




    public function report(){
    $questions = Question::with(['student', 'employee'])
    ->whereHas('student', function($query) {
        $query->whereNotNull('user_id');
    })
    ->orWhereHas('employee') // Checks if employee relationship exists
    ->get();



                          


        return view('admin.report',compact('questions'));
    }
    public function deletequestion($id){
        $question = Question::find($id);
        $question->delete();
         return redirect()->back();
    }

    public function showCreateProgram(){
        $schools = School::all();
        return view('admin.program.create', compact('schools'));
    }
     public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

