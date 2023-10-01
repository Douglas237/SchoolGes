<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEleveRequest extends FormRequest
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
            //
            'nom' =>'required',
            'prenom' =>'required',
            'genre' =>'required|string',
            'photo' => "image|mimes:jpeg,png,jpg,gif,svg",
            'telephone' =>'required|string',
            'date_naissance' =>'required',
            'lieu_naissance' =>'required|string',
            'region_origine' =>'required|string',
            'lieu_origine' =>'required|string',
            'salleclasse_id' =>'required|exists:salle_classes,id',
            'classe_id' =>'required',
        ];
    }
}
