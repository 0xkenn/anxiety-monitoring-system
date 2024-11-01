<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoordinatorRequest extends FormRequest
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
                    'school_id' => 'max:30',
                 'coordinator_id' => 'string',
                  'last_name'=>  'string',
                  'first_name'=>  'string',
                  'middle_name'=> 'string',
                  'sex'=> 'string',
                   'password'=>'string',
                   'mobile_number'=>'string',
                   'email'=>'string',
        ];
    }
}
