<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFichediciplinaireRequest extends FormRequest
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
            'eleve_id' => 'required|integer',
            'sanction' => 'required',
            'motif' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'description' => 'required',
        ];
    }
}
