<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusStoreRequest extends FormRequest
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
                'nom_bus' => 'required|string|max:258',
                'capaciter' => 'required|numeric',
                'chauffeur' => 'required|string',
                'description' => 'required|string',
            ];
        } else {
            return [
                'nom_bus' => 'required|string|max:258',
                'capaciter' => 'required|numeric',
                'chauffeur' => 'required|string',
                'description' => 'required|string',
            ];
        }
    }


    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'nom_bus.required' => 'nom_bus is required!',
                'capaciter.required' => 'capaciter is required!',
                'chauffeur.required' => 'chauffeur is required!',
                'description.required' => 'Description is required!',
            ];
        } else {
            return [
                'nom_bus.required' => 'nom_bus is required!',
                'capaciter.required' => 'capaciter is required!',
                'chauffeur.required' => 'chauffeur is required!',
                'description.required' => 'Description is required!',
            ];
        }
    }
}
