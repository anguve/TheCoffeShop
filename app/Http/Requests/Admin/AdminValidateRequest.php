<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
  

    public function rules()
    {
        $regEmail = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
        $regUsername = "/^[A-Za-z][A-Za-z0-9_]{8,29}$/";
        $regPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%.&*?])[A-Za-z\d#$@!%.&*?]{8,100}$/";        
       
        return [
            'name'=> 'required|string|min:1|max:25|',
            'email'=> "required|string|email|max:100|regex:$regEmail",
            'password'=> "required|string|min:8|max:100|regex:$regPassword",
            'username'=> "required|string|min:8|max:20|regex:$regUsername",
            'roll'=> 'required||min:1|max:100|string',
            'status'=>'required|boolean',  
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 400,
            'errors' => $validator->errors()->all(),
        ], 200));
    }
}