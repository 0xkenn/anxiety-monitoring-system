<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StudentLoginRequest;
use App\Models\Program;
use App\Models\School;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function create()
    {
        $programs = Program::all();
  
        return view('student.register', compact('programs' ));
    }

    public function store(StoreStudentRequest $request)
{
    
    $data = $request->validated();
   
    $programId = $data['program_id'];
    $program = Program::find($programId);
    
      $data['school_id'] = $program->school_id;
 

    $data['password'] = Hash::make( $data['password']);

    Student::create($data);
    return redirect()->route('student.dashboard')
                     ->with('success', 'Registration successful!');
}

    public function login()
    {
        return view('student.login');
    }

   public function authenticate(StudentLoginRequest $request)
{
    // Validate the request and get the validated data
    $data = $request->authorize();
    

    // Attempt to authenticate the student using the credentials
    
       if(Auth::guard('student')->attempt(['user_id' =>$request->user_id,'password' => $request->password])){
         $request->session()->regenerate();
         return redirect()->route('student.dashboard');
       }
         return back()->withErrors([
        'user_id' => 'Invalid user ID or Password.',
        'password' => 'Invalid user ID or Password.' 
    ])->withInput($request->except('password'));  

        // Redirect to the student dashboard after successful login
        
    }



    public function dashboard()
    {
        
         $name = auth()->guard('student')->user()->first_name;
        return view('student.home', compact('name'));
    }

    public function history()
    {
        return view('student.history');
    }

    public function assessment()
    {
        return view('student.assessment');
    }

    public function home()
    {
            $name = auth()->guard('student')->user()->first_name;
        return view('student.home', compact('name'));
    }

    public function contact()
    {
        return view('student.contact');
    }

    public function edit($id)
    {
        $student = Student::find($id);

        if ($student && session('student_id') == $student->student_id) {
            return view('student.edit', compact('student'));
        }

        return redirect()->route('student.profile')->withErrors(['edit' => 'Unauthorized or student not found']);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student && session('student_id') == $student->student_id) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,' . $id,
                'gender' => 'required|string',
                'birthdate' => 'required|date',
                'school' => 'required|string',
                'mobile_number' => 'required|numeric',
                'province' => 'required|string',
                'municipality' => 'required|string',
                'barangay' => 'required|string',
            ]);

            $student->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'gender' => $request->input('gender'),
                'birthdate' => $request->input('birthdate'),
                'school' => $request->input('school'),
                'mobile_number' => $request->input('mobile_number'),
                'province' => $request->input('province'),
                'municipality' => $request->input('municipality'),
                'barangay' => $request->input('barangay'),
            ]);

            return redirect()->route('student.profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('student.profile')->withErrors(['update' => 'Unauthorized or student not found']);
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('student.show', compact('student'));
    }

    public function logout(Request $request){
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function profile($id)
{
    $student = Student::findOrFail($id);
    return view('student.profile', compact('student'));
}
   
}
