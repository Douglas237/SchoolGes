<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SecteurEnseignementStoreRequest extends FormRequest
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
                'libeller' => 'required|string',
                'description' => 'required',
            ];
        } else {
            return [
                'libeller' => 'required|string',
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
                'libeller.required' => 'LIBELLER is required!',
                'description.required' => 'Description is required!',
            ];
        } else {
            return [
                'libeller.required' => 'LIBELLER is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
