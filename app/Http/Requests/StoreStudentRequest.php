<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'program_id'=> 'required',
            'user_id' => 'required|regex:/^[0-9!@#$%^&*()_+=-]*$/|min:10|unique:students,user_id',
            'password' => 'required|string|min:8|confirmed',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'sex' => 'required|string|in:male,female',
            'mobile_number' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
        ];
    }
}