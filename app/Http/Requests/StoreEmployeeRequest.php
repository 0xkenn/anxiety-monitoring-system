<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

             'school_id'=>'required',
            'employee_id' => 'required|string|min:10|unique:employees,employee_id',
            'password' => 'required|string|min:8|confirmed',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'sex' => 'required|string|in:male,female',
            'mobile_number' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
        ];
        
    }
}
