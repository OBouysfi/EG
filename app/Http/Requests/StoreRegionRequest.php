<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:regions,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la région est obligatoire.',
            'name.string' => 'Le nom de la région doit être une chaîne de caractères.',
            'name.max' => 'Le nom de la région ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Une région avec ce nom existe déjà.',
        ];
    }
}