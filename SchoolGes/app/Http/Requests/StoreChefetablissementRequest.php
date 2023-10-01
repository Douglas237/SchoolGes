<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChefetablissementRequest extends FormRequest
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
            "name" => "required|min:5",
            "prenom" => "required|min:5",
            "date_naissance" => "required|date",
            "lieu_naissance" => "required|string",
            "region_naissance" => "required|string",
            "cni" => "required|string",
            "ville_residence" => "required|string",
            "pays" => "required|string",
            "adresse" => "required|string",
            "telephone" => "required|string",
            "image" => "image|mimes:jpeg,png,jpg,gif,svg",
            "sexe" => "required|string",
            "description" => "required|string",
            "email" => "required|email|unique:chefetablissements,email",
            "password" => "required",
        ];
    }
}
