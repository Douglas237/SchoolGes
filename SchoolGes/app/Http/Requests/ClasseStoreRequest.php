<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseStoreRequest extends FormRequest
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
    public function rules()
    {
        if (request()->isMethod('post')) {
            return [
                'etablissement_id' => 'required|integer',
                'classesyst_id' => 'required|integer',
                'nom_classe' => 'required|string|max:258',
                'description' => 'required|string',
                'code_classe' =>'required|string'
            ];
        } else {
            return [
                'etablissement_id' => 'required|integer',
                'classesyst_id' => 'required|integer',
                'nom_classe' => 'required|string|max:258',
                'code_classe' =>'required|string',
                'description' => 'required|string',
            ];
        }
    }


    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'etablissement_id' => 'required|integer',
                'classesyst_id' => 'required|integer',
                'nom_classe.required' => 'nom_classe is required!',
                'code_classe.required' =>'code_classe is required!',
                'description.required' => 'Description is required!',

            ];
        } else {
            return [
                'etablissement_id' => 'required|integer',
                'classesyst_id' => 'required|integer',
                'nom_classe.required' => 'nom_classe is required!',
                'code_classe.required' =>'code_classe is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
