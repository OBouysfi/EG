<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCentreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la centre est obligatoire.',
            'name.string' => 'Le nom de la centre doit être une chaîne de caractères.',
            'name.max' => 'Le nom de la centre ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Une centre avec ce nom existe déjà.',
        ];
    }
}
