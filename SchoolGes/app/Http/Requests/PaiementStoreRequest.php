<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaiementStoreRequest extends FormRequest
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
                'montant_totale' => 'required|integer',
                'type_paiement_id' => 'required|integer',
                'Avance' => 'required',
                'tranches' => 'required',
                'moratoire' => 'required',
            ];
        } else {
            return [
                'montant_totale' => 'required|integer',
                'type_paiement_id' => 'required|integer',
                'Avance' => 'required',
                'tranches' => 'required',
                'moratoire' => 'required',
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
                'montant_totale.required' => 'montant_totale is required!',
                'type_paiement_id.required' => 'type paiement id is required!',
                'Avance.required' => 'Avance is required!',
                'tranches.required' => 'tranches is required!',
                'moratoire.required' => 'moratoire is required!',
            ];
        } else {
            return [
                'montant_totale.required' => 'montant_totale is required!',
                'type_paiement_id.required' => 'type paiement id is required!',
                'Avance.required' => 'Avance is required!',
                'tranches.required' => 'tranches is required!',
                'moratoire.required' => 'moratoire is required!',
            ];
        }
    }
}
