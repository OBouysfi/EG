<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Models\Paiement;
use App\Models\Participant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('participant')->get();
        return view('paiements.listing', compact('paiements'));
    }

    public function data()
    {
        $paiements = Paiement::with('participant')->select('paiements.*');

        return DataTables::of($paiements)
            ->addColumn('participant', function ($paiement) {
                return $paiement->participant->nom_prenom;
            })
            ->addColumn('actions', function ($paiement) {
                return '<div class="btn-group" role="group">' .
                       '<button type="button" class="btn btn-warning btn-sm" onclick="editPaiement(' . $paiement->id . ')">' .
                       '<i class="fa fa-edit"></i></button>' .
                       '<button type="button" class="btn btn-danger btn-sm" onclick="deletePaiement(' . $paiement->id . ')">' .
                       '<i class="fa fa-trash"></i></button></div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function create()
    {
        $participants = Participant::all();
        $seances = ['S1', 'S2', 'S3', 'S4', 'Centre'];
        return view('paiements.create', compact('participants', 'seances'));
    }

    public function store(StorePaiementRequest $request)
    {
        $validatedData = $request->validated();
        $paiement = Paiement::create($validatedData);
    
        // Update the participant's reste
        $participant = $paiement->participant;
        $totalPaiements = $participant->paiements()->sum('montant');
        $participant->reste = $participant->montant_inscription - $totalPaiements;
        $participant->save();
    
        return redirect()->route('paiements.index')->with('success', 'Paiement ajouté avec succès');
    }

    public function edit(Paiement $paiement)
    {
        $participants = Participant::all();
        $seances = ['S1', 'S2', 'S3', 'S4', 'Centre'];
        return response()->json([
            'paiement' => $paiement,
            'participants' => $participants,
            'seances' => $seances
        ]);
    }
    
    public function update(UpdatePaiementRequest $request, Paiement $paiement)
    {
        $oldMontant = $paiement->montant;
        $paiement->update($request->validated());
    
        // Recalculate the participant's reste
        $participant = $paiement->participant;
        $totalPaiements = $participant->paiements()->sum('montant');
        $participant->reste = $participant->montant_inscription - $totalPaiements;
        $participant->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Paiement mis à jour avec succès',
            'paiement' => $paiement
        ]);
    }

    public function destroy(Paiement $paiement)
    {
        $participant = $paiement->participant;
        $paiement->delete();
    
        // Recalculate the participant's reste
        $totalPaiements = $participant->paiements()->sum('montant');
        $participant->reste = $participant->montant_inscription - $totalPaiements;
        $participant->save();
    
        return response()->json(['message' => 'Paiement supprimé avec succès']);
    }
}
