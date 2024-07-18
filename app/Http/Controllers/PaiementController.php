<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Models\Paiement;
use App\Models\Participant;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function store(StorePaiementRequest $request, Participant $participant)
    {
        $participant->paiements()->create($request->validated());

        return redirect()->route('participants.index')->with('success', 'Paiement ajouté avec succès');
    }

    public function edit(Paiement $paiement)
    {
        return view('paiements.edit', compact('paiement'));
    }

    public function update(UpdatePaiementRequest $request, Paiement $paiement)
    {
        $paiement->update($request->validated());

        return redirect()->route('participants.index')->with('success', 'Paiement mis à jour avec succès');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return response()->json(['message' => 'Paiement supprimé avec succès']);
    }
}
