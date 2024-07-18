<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'centre_id' => 'required|exists:centres,id',
            'nom_prenom' => 'required|string|max:255',
            'numero_cin' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'ville_naissance' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville_centre' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'categorie' => 'required|string|max:255',
            'montant_inscription' => 'required|numeric',
            'commercial' => 'required|string|max:255',
            'etat' => 'required|string|in:Non,Livré',
            'reste' => 'required|numeric',
        ];
    }
}
