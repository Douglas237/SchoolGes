<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SequencesStoreRequest extends FormRequest
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
                'num_sequences' => 'required|integer',
                'libeller' => 'required|string',
                'DEBUT_COURS' => 'required|date',
                'FIN_COURS' => 'required|date',
                'DEBUT_EVALUATION' => 'required|date',
                'FIN_EVALUATION' => 'required|date',
                'DEBUT_RESULTAT' => 'required|date',
                'FIN_RESULTAT' => 'required|date',
                'trimestre_id' => 'required',
                'description' => 'required|string',
            ];
        } else {
            return [
                'num_sequences' => 'required|integer',
                'libeller' => 'required|string',
                'DEBUT_COURS' => 'required|date',
                'FIN_COURS' => 'required|date',
                'DEBUT_EVALUATION' => 'required|date',
                'FIN_EVALUATION' => 'required|date',
                'DEBUT_RESULTAT' => 'required|date',
                'FIN_RESULTAT' => 'required|date',
                'trimestre_id' => 'required',
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
                'num_sequences.required' => 'num_sequences is required!',
                'libeller.required' => 'libeller is required!',
                'DEBUT_COURS.required' => 'DEBUT_COURS is required!',
                'FIN_COURS.required' => 'FIN_COURS is required!',
                'DEBUT_EVALUATION.required' => 'DEBUT_EVALUATION is required!',
                'FIN_EVALUATION.required' => 'FIN_EVALUATION is required!',
                'DEBUT_RESULTAT.required' => 'DEBUT_RESULTAT is required!',
                'FIN_RESULTAT.required' => 'FIN_RESULTAT is required!',
                'trimestre_id.required' => 'trimestre_id is required!',
                'description.required' => 'Description is required!',
            ];
        } else {
            return [
                'num_sequences.required' => 'num_sequences is required!',
                'libeller.required' => 'libeller is required!',
                'DEBUT_COURS.required' => 'DEBUT_COURS is required!',
                'FIN_COURS.required' => 'FIN_COURS is required!',
                'DEBUT_EVALUATION.required' => 'DEBUT_EVALUATION is required!',
                'FIN_EVALUATION.required' => 'FIN_EVALUATION is required!',
                'DEBUT_RESULTAT.required' => 'DEBUT_RESULTAT is required!',
                'FIN_RESULTAT.required' => 'FIN_RESULTAT is required!',
                'trimestre_id.required' => 'trimestre_id is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
