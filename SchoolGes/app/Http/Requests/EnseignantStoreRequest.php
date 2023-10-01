<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EnseignantStoreRequest extends PersonneRequest
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
                'NOM' => 'required|string',
                'PRENOM' => 'required',
                'DATE_NAISSANCE' => 'required',
                'REGION_ORIGINE' => 'required',
                'LIEU_NAISSANCE' => 'required',
                'ADRESSE' => 'required',
                'CNI' => 'required',
                'VILLE_RESIDENCE' => 'required',
                'PAYS' => 'required',
                'TELEPHONE' => 'required',
                'EMAIL' => 'required',
                'IMAGE' => 'required',
                'SEXE' => 'required',
                'id_typeEnseignant' => 'required|integer',
                'id_matiere' => 'required|integer',
                'description' => 'required',
            ];
        } else {
            return [
                'NOM' => 'required|string',
                'PRENOM' => 'required',
                'DATE_NAISSANCE' => 'required',
                'REGION_ORIGINE' => 'required',
                'LIEU_NAISSANCE' => 'required',
                'ADRESSE' => 'required',
                'CNI' => 'required',
                'VILLE_RESIDENCE' => 'required',
                'PAYS' => 'required',
                'TELEPHONE' => 'required',
                'EMAIL' => 'required',
                'IMAGE' => 'required',
                'SEXE' => 'required',
                'id_typeEnseignant' => 'required|integer',
                'id_matiere' => 'required|integer',
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
                'NOM.required' => 'NOM is required!',
                'PRENOM.required' => 'PRENOM is required!',
                'DATE_NAISSANCE.required' => 'DATE_NAISSANCE is required!',
                'REGION_ORIGINE.required' => 'REGION_ORIGINE is required!',
                'LIEU_NAISSANCE.required' => 'LIEU_NAISSANCE is required!',
                'ADRESSE.required' => 'ADRESSE is required!',
                'CNI.required' => 'CNI is required!',
                'VILLE_RESIDENCE.required' => 'VILLE_RESIDENCE is required!',
                'PAYS.required' => 'PAYS is required!',
                'TELEPHONE.required' => 'TELEPHONE is required!',
                'EMAIL.required' => 'EMAIL is required!',
                'IMAGE.required' => 'IMAGE is required!',
                'SEXE.required' => 'SEXE is required!',
                'id_typeEnseignant.required' => 'id_typeEnseignant is required!',
                'id_matiere.required' => 'id_matiere is required!',
                'description.required' => 'Description is required!',
            ];
        } else {
            return [
                'NOM.required' => 'NOM is required!',
                'PRENOM.required' => 'PRENOM is required!',
                'DATE_NAISSANCE.required' => 'DATE_NAISSANCE is required!',
                'REGION_ORIGINE.required' => 'REGION_ORIGINE is required!',
                'LIEU_NAISSANCE.required' => 'LIEU_NAISSANCE is required!',
                'ADRESSE.required' => 'ADRESSE is required!',
                'CNI.required' => 'CNI is required!',
                'VILLE_RESIDENCE.required' => 'VILLE_RESIDENCE is required!',
                'PAYS.required' => 'PAYS is required!',
                'TELEPHONE.required' => 'TELEPHONE is required!',
                'EMAIL.required' => 'EMAIL is required!',
                'IMAGE.required' => 'IMAGE is required!',
                'SEXE.required' => 'SEXE is required!',
                'id_typeEnseignant.required' => 'id_typeEnseignant is required!',
                'id_matiere.required' => 'id_matiere is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
