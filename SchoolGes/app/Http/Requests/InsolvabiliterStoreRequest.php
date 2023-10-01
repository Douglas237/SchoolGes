<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InsolvabiliterStoreRequest extends FormRequest
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
                'eleve_id' => 'required|integer',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'periode_debut' => 'required',
                'periode_fin' => 'required',
                'description' => 'required',
            ];
        } else {
            return [
                'eleve_id' => 'required|integer',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'periode_debut' => 'required',
                'periode_fin' => 'required',
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
                'eleve_id.required' => 'eleve_id is required!',
                'date_debut.required' => 'date_debut is required!',
                'date_fin.required' => 'date_fin is required!',
                'periode_debut.required' => 'periode_debut is required!',
                'periode_fin.required' => 'periode_fin is required!',
                'description.required' => 'description is required!',
            ];
        } else {
            return [
                'eleve_id.required' => 'eleve_id is required!',
                'date_debut.required' => 'date_debut is required!',
                'date_fin.required' => 'date_fin is required!',
                'periode_debut.required' => 'periode_debut is required!',
                'periode_fin.required' => 'periode_fin is required!',
                'description.required' => 'description is required!',
            ];
        }
    }
}
