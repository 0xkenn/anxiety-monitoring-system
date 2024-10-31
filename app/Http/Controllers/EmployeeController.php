<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\EmployeeLoginRequest;
use App\Models\Question;
use App\Models\School;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function create()
    {
        $schools = School::all();
        return view('employee.register', compact('schools'));
    }

    public function store(StoreEmployeeRequest $request)
{
   
    $data = $request->validated();
    
    $data['password'] = Hash::make( $data['password']);

    Employee::create($data);
    return redirect()->route('employee.login')
                     ->with('success', 'Registration successful!');
}

    public function login()
    {
        return view('employee.login');
    }

   public function authenticate(EmployeeLoginRequest $request)
{
    // Validate the request and get the validated data
    $request->authorize();
    
    

    // Attempt to authenticate the employee using the credentials
    
       if(Auth::guard('employee')->attempt(['employee_id' =>$request->employee_id,'password' => $request->password])){
         $request->session()->regenerate();
         return redirect()->route('employee.dashboard');
       }
         return back()->withErrors([
        'employee_id' => 'Invalid user ID or password.',
        'password' => 'Invalid user ID or password.' 
    ])->withInput($request->except('password'));  

        // Redirect to the student dashboard after successful login
        
    }

    // If authentication fails, redirect back with an error message and old input
   



    public function dashboard()
    {
        $employeeId = auth()->guard('employee')->id();
       $name = auth()->guard()->user()->first_name;
        
        return view('employee.home', compact('name', 'employeeId'));
    }

    public function history()

    {
        $id = Auth::guard('employee')->id();
        $histories = Question::with('employee')->where('employee_id', $id)->get();
       return view('employee.history', compact('histories'));
       //$id = Auth::guard('employee')->id();

      
      //  $questions = Question::with('employee')->where('employee_id', $id)->get();
      //  return view('employee.history',compact('questions'));
    }

    public function assessment()
    {
        return view('employee.assessment');
    }

    public function home()
    {
        $name = auth()->guard()->user()->first_name;
        
        return view('employee.home', compact('name'));
    }

    public function contact()
    {
        return view('employee.contact');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);

        if ($employee && session('employee_id') == $employee->employee_id) {
            return view('employee.edit', compact('employee'));
        }

        return redirect()->route('employee.profile')->withErrors(['edit' => 'Unauthorized or Employee not found']);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
      if ($employee && session('employee_id') == $employee->employee_id) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,' . $id,
                'gender' => 'required|string',
                'birthdate' => 'required|date',
                'mobile_number' => 'required|numeric',
                'province' => 'required|string',
                'municipality' => 'required|string',
                'barangay' => 'required|string',
            ]);

            $employee->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'gender' => $request->input('gender'),
                'birthdate' => $request->input('birthdate'),
                'mobile_number' => $request->input('mobile_number'),
                'province' => $request->input('province'),
                'municipality' => $request->input('municipality'),
                'barangay' => $request->input('barangay'),
            ]);

            return redirect()->route('employee.profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('employee.profile')->withErrors(['update' => 'Unauthorized or Employee not found']);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.profile', compact('employee'));
    }

    public function logout(Request $request){
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}