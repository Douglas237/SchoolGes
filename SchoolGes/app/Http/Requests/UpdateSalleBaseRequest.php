<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSalleBaseRequest extends FormRequest
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
            'code_salle'=> 'required',
            'intitule_salle'=> 'required',
            'capacite_salle'=> 'required',
            'tronc_commun'=> 'required',
            'nombre_tronc'=> 'required',
            'description'=> 'required'
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
