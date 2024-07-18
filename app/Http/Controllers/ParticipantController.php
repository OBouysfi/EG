<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Centre;
use App\Models\Paiement;
use App\Models\Participant;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ParticipantController extends Controller
{
    public function index()
    {
        return view('participants.listing');
    }

    public function data()
    {
        $participants = Participant::with('centre')->select('participants.*');
    
        return DataTables::of($participants)
            ->addColumn('centre', function ($participant) {
                return $participant->centre ? $participant->centre->name : 'N/A';
            })
            ->addColumn('actions', function ($participant) {
                return view('participants.actions', compact('participant'))->render();
            })
            ->make(true);
    }

    public function create()
    {
        $centres = Centre::all();
        return view('participants.create', compact('centres'));
    }

    public function store(StoreParticipantRequest $request)
    {
        Participant::create($request->validated());

        return redirect()->route('participants.index')->with('success', 'Participant ajouté avec succès');
    }

    public function edit(Participant $participant)
    {
        $centres = Centre::all();
        return response()->json([
            'participant' => $participant,
            'centres' => $centres
        ]);
    }

    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $participant->update($request->validated());

        return response()->json(['message' => 'Participant mis à jour avec succès']);
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return response()->json(['message' => 'Participant supprimé avec succès']);
    }

    public function storePaiement(Request $request, Participant $participant)
    {
        $request->validate([
            'seance' => 'required|string',
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
        ]);

        $paiement = new Paiement([
            'seance' => $request->seance,
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement,
        ]);

        $participant->paiements()->save($paiement);

        return response()->json(['message' => 'Paiement ajouté avec succès']);
    }
}
