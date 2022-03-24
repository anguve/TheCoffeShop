<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductValidateRequest extends FormRequest
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
        return [
            'name'=> 'required|string|max:100',
            'price'=> 'required|numeric|between:0,99.99',
            'stock'=> 'required|integer',
            'reference'=> 'required|string',
            'description'=> 'required|string',
            'status'=>'required|boolean',  
            'category'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,svg|max:1024',
  
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