<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateEtablissemtNiveauRequest extends FormRequest
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
            'etablissement_id' => 'required|integer',
            'niveauenseignement_id' => 'required|integer',
            'numero_autorisation' => 'required',
            'adress_email' => 'required',
            'numero_telephone' => 'required'
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
