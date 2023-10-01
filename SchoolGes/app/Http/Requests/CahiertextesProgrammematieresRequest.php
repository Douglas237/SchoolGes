<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CahiertextesProgrammematieresRequest extends FormRequest
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
                'prgMatiere_id' => 'required',
                'cahiertexte_id' => 'required',
            ];
        } else {
            return [
                'prgMatiere_id' => 'required',
                'cahiertexte_id' => 'required',
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
                'prgMatiere_id.required' => 'prgMatiere_id is required!',
                'cahiertexte_id.required' => 'cahiertexte_id is required!',
            ];
        } else {
            return [
                'prgMatiere_id.required' => 'prgMatiere_id is required!',
                'cahiertexte_id.required' => 'cahiertexte_id is required!',
            ];
        }
    }
}
