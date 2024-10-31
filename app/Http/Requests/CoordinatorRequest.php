<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoordinatorRequest extends FormRequest
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
                 'coordinator_id' => 'required',
                  'last_name'=>  'required',
                  'first_name'=>  'required',
                  'middle_name'=> 'required',
                  'sex'=> 'required',
                   'password'=>'required',
                   'mobile_number'=>'required',
                   'email'=>'required',
        ];
    }
}
