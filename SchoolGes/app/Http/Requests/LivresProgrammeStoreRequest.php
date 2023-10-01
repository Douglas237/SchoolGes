<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LivresProgrammeStoreRequest extends FormRequest
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
                'TITRE_LIVRE' => 'required|string',
                'DOMAINE' => 'required',
                'GROUPEMENT' => 'required',
                'EDITION' => 'required',
                'hauteur' => 'required',
                'description' => 'required',
            ];
        } else {
            return [
                'TITRE_LIVRE' => 'required|string',
                'DOMAINE' => 'required',
                'GROUPEMENT' => 'required',
                'EDITION' => 'required',
                'hauteur' => 'required',
                'description' => 'required',
            ];
        }

    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>true,
            'message'=>'erreur de validation',
            'errorList'=> $validator->errors(),
        ])
        );
    }
    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'TITRE_LIVRE.required' => 'TITRE_LIVRE is required!',
                'DOMAINE.required' => 'DOMAINE is required!',
                'GROUPEMENT.required' => 'GROUPEMENT is required!',
                'EDITION.required' => 'EDITION is required!',
                'hauteur.required' => 'hauteur is required!',
                'description.required' => 'Description is required!',
            ];
        } else {
            return [
                'TITRE_LIVRE.required' => 'TITRE_LIVRE is required!',
                'DOMAINE.required' => 'DOMAINE is required!',
                'GROUPEMENT.required' => 'GROUPEMENT is required!',
                'EDITION.required' => 'EDITION is required!',
                'hauteur.required' => 'hauteur is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
