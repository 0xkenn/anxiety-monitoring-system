<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller

{

    public function create()
    {
        return view('user.user_register'); 
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:users,user_id', 
            'password' => 'required|min:8|confirmed',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'sex' => 'required|string',
            'birthdate' => 'required|date|before:today', 
            'school' => 'nullable|string',
            'mobile_number' => 'nullable|string|regex:/^([0-9]+)*$/', 
            'email' => 'required|string|email|unique:users',
            'province' => 'required|string',
            'municipality' => 'required|string',
            'barangay' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'user_id' => $request->user_id,
            'password' => Hash::make($request->password),
            'last_name' => $request->first_name,
            'first_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'sex' => $request->sex,
            'birthdate' => $request->birthdate, 
            'school' => $request->school,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'province' => $request->province,
            'municipality' => $request->municipality,
            'barangay' => $request->barangay,
        ]);

        // Optionally, authenticate the user after registration
        // Auth::login($user); // Uncomment if desired

        return redirect('/user/dashboard'); 
    }
    public function userDashboard()
    {
        return view('user.user_dashboard');
    }
    
    public function userLogin()
    {
        return view('user.user_login');
    }
    
    public function userRegister()
    {
        return view('user.user_register');
    }
    
    public function userHome()
    {
        return view('user.user_home');
    }
    
    public function userAssessment()
    {
        return view('user.user_assessment');
    }
    
    public function userHistory()
    {
        return view('user.user_history');
    }

    public function userAboutUs()
    {
        return view('user.user_about_us');
    }



}