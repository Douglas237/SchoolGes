<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Paiement_typePaiementStoreRequest extends FormRequest
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
                'type_paiement_id' => 'required',
                'paiement_id' => 'required',
            ];
        } else {
            return [
                'type_paiement_id' => 'required',
                'paiement_id' => 'required',
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
                'type_paiement_id.required' => 'type_paiement_id is required!',
                'paiement_id.required' => 'paiement_id is required!',
            ];
        } else {
            return [
                'type_paiement_id.required' => 'type_paiement_id is required!',
                'paiement_id.required' => 'paiement_id is required!',
            ];
        }
    }
}
