<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            "enseignant_id" => "required|integer",
            "matiere_id" => "required|integer",
            "sequence_id" => "required|integer",
            "eleve_id" => "required|integer",
            "trimestre_id" => "required|integer",
            "classe_id" => "required|integer",
            "sallebase_id" => "required|integer",
            "note" => "required",
        ];
    }
}
