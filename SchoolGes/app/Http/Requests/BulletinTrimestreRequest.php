<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulletinTrimestreRequest extends FormRequest
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
            "classe_id" => "required|integer|exists:classes,id",
            "trimestre_id" => "required|integer|exists:trimestres,id",
            "eleve_id" => "required|integer|exists:eleves,id",
        ];
    }
}
