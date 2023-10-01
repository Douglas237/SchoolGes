<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class periodeStoreRequest extends FormRequest
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
                'NUM_PERIODE' => 'required|integer',
                'libeller' => 'required',
                'HEURE_DEBUT' => 'required',
                'HEURE_FIN' => 'required',
                //'valeur_reelle' => 'required',
                'pause' => 'required',
                'description' => 'required',
                'etablissement_id' => 'required',
            ];
        } else {
            return [
                'NUM_PERIODE' => 'required|integer',
                'libeller' => 'required',
                'HEURE_DEBUT' => 'required',
                'HEURE_FIN' => 'required',
                'description' => 'required',
                'etablissement_id' => 'required',
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
                'NUM_PERIODE.required' => 'NUM_PERIODE is required!',
                'libeller.required' => 'libeller is required!',
                'HEURE_DEBUT.required' => 'HEURE_DEBUT is required!',
                'HEURE_FIN.required' => 'HEURE_FIN is required!',
                'description.required' => 'description is required!',
                'etablissement_id.required' => 'etablissement_id is required!',
            ];
        } else {
            return [
                'NUM_PERIODE.required' => 'NUM_PERIODE is required!',
                'libeller.required' => 'libeller is required!',
                'HEURE_DEBUT.required' => 'HEURE_DEBUT is required!',
                'HEURE_FIN.required' => 'HEURE_FIN is required!',
                'description.required' => 'description is required!',
                'etablissement_id.required' => 'etablissement_id is required!',
            ];
        }
    }
}
