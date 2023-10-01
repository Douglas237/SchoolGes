<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ElevePaiementStoreRequest extends FormRequest
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

            return [
                'eleve_id' => 'required',
                // 'paiement_id' => 'required',
                'montant_payer' => 'required',
                'date' => 'required',
                // 'statut_insolvabilite' => 'required',
                // 'statut_classe' => 'required',
                // 'statut_etablissement' => 'required',
                'tranche' => 'required',
            ];


    }



}
