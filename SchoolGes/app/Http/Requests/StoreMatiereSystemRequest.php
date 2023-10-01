<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMatiereSystemRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'admincirconscription_id' => 'required|integer',
            'typeenseignemt_id' => 'required|integer',
            'niveauenseignemt_id' => 'required|integer',
            'cycleenseignemt_id' => 'required|integer',
            'intitule_generale' => 'required',
            'groupement' => 'required',
            'domaine' => 'required',
            'type' => 'required',
            'classification' => 'required',
            'coefficient_generale' => 'required',
            'volumehoraire_system' => 'required',
            'description' => 'required'
        ];
    }

    public function failedValidation(Validator $validator) {

        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error' => true,
            'message'=>'erreur de validation',
            'errorsList'=> $validator->errors()
        ]));

    }
}
