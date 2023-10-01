<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtablissementRequest extends FormRequest
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
            'nom' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'adress_postal' => 'required|string',
            'abreviation_nom' => 'required|string|min:2',
            'devise' => 'required|string|min:2',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'adresse_email' => 'required|string|email',
            'telephone' => 'required|string',
            'siege_sociale' => 'required|string',
            'chefetablissement_id' => 'required|integer|exists:chefetablissements,id',
        ];
    }
}
