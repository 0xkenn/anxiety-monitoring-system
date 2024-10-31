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
        return view ('admin.dashboard');
    }
    public function Login(){
        return view ('admin.login');
    }
    public function adminRegister(){
        return view ('admin.register');
    }
     public function Home(){
        return view ('admin.home');
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

