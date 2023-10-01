<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TypeAccessStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        if (request()->isMethod('post')) {
            return [
                'acces_validation' => 'required|boolean',
                'validite' => 'required',
                'description' => 'required',
            ];
        } else {
            return [
                'acces_validation' => 'required|boolean',
                'validite' => 'required',
                'description' => 'required',
            ];
        }
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>true,
            'message'=>'erreur de validation',
            'errorList'=> $validator->errors(),
        ])
        );
    }


    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'acces_validation.required' => 'LIBELLER is required!',
                'validite.required' => 'DATE_CREATION is required!',
                'description.required' => 'Description is required!',
            ];
        } else {
            return [
                'acces_validation.required' => 'LIBELLER is required!',
                'validite.required' => 'DATE_CREATION is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
