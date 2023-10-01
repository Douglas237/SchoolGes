<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatiereRequest extends FormRequest
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

            'classe_id' => 'required|integer',
            'etablissement_id'=>'required|integer',
            'matieresyst_id'=>'required|integer',
            'code_matiere' => 'required',
            'intituler_etablissement' => 'required',
            'volumehoraire_etablissement' => 'required',
            'coefficient_etablissement' => 'required',
            'description' => 'required'
        ];
    }
}
