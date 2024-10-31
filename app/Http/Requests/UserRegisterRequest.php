<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            //
            'user_id' => 'required|unique:users,user_id',
            'password' => 'required|min:8',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'birthdate' => 'required|date',
            'gender' => 'required',
            'school' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email',
            'province' => 'required',
            'municipality' => 'required',
            'barangay' => 'required',
        ];
    }
}
