<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CounselorRequest extends FormRequest
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
            'school_id' => 'required',
               'counselor_id'=>'required|string',
                 'last_name' => 'required|string',
                 'first_name'=>'required|string',
                  'middle_name'=>'required|string',
                  'sex'=>'required|string',
                  'password'=>'required|string',
                   'mobile_number'=>'required|string|max:11',
                  'email'=>'required|email|max:50|unique:counselors,email',
        ];
    }
}
