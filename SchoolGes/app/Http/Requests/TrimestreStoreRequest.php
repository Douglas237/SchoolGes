<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TrimestreStoreRequest extends FormRequest
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
                'num_trimestre' => 'required|integer',
                'libeller' => 'required|string',
                'DEBUT_COURS' => 'required|date',
                'FIN_COURS' => 'required|date',
                'DEBUT_EVALUATION' => 'required|date',
                'FIN_EVALUATION' => 'required|date',
                'DEBUT_RESULTAT' => 'required|date',
                'FIN_RESULTAT' => 'required|date',
                'Debut_Conger' => 'required|date',
                'description' => 'required|string',
            ];
        } else {
            return [
                'num_trimestre' => 'required|integer',
                'libeller' => 'required|string',
                'DEBUT_COURS' => 'required|date',
                'FIN_COURS' => 'required|date',
                'DEBUT_EVALUATION' => 'required|date',
                'FIN_EVALUATION' => 'required|date',
                'DEBUT_RESULTAT' => 'required|date',
                'FIN_RESULTAT' => 'required|date',
                'Debut_Conger' => 'required|date',
                'description' => 'required|string',
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
                'num_trimestre.required' => 'num_trimestre is required!',
                'libeller.required' => 'libeller is required!',
                'DEBUT_COURS.required' => 'DEBUT_COURS is required!',
                'FIN_COURS.required' => 'FIN_COURS is required!',
                'DEBUT_EVALUATION.required' => 'DEBUT_EVALUATION is required!',
                'FIN_EVALUATION.required' => 'FIN_EVALUATION is required!',
                'Debut_Conger.required' => 'Debut_Conger is required!',
                'DEBUT_RESULTAT.required' => 'DEBUT_RESULTAT is required!',
                'FIN_RESULTAT.required' => 'FIN_RESULTAT is required!',
                'description.required' => 'Description is required!',
            ];
        } else {
            return [
                'num_trimestre.required' => 'num_trimestre is required!',
                'libeller.required' => 'libeller is required!',
                'DEBUT_COURS.required' => 'DEBUT_COURS is required!',
                'FIN_COURS.required' => 'FIN_COURS is required!',
                'DEBUT_EVALUATION.required' => 'DEBUT_EVALUATION is required!',
                'FIN_EVALUATION.required' => 'FIN_EVALUATION is required!',
                'Debut_Conger.required' => 'Debut_Conger is required!',
                'DEBUT_RESULTAT.required' => 'DEBUT_RESULTAT is required!',
                'FIN_RESULTAT.required' => 'FIN_RESULTAT is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
