<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Centre;
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
                return $participant->centre->name; // Assurez-vous que le modèle Centre a un champ 'name'
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
        return view('participants.edit', compact('participant', 'centres'));
    }

    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $participant->update($request->validated());

        return redirect()->route('participants.index')->with('success', 'Participant mis à jour avec succès');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return response()->json(['message' => 'Participant supprimé avec succès']);
    }
}
