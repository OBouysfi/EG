<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Centre;
use App\Models\Paiement;
use App\Models\Participant;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $centres = Centre::all();
        $regions = Region::all();
    
        return view('participants.listing', compact('centres', 'regions'));
    }
    

    public function data(Request $request)
{
    $query = Participant::with('centre');

    if ($request->has('centre_id') && $request->centre_id != '') {
        $query->where('centre_id', $request->centre_id);
    }

    if ($request->has('region_id') && $request->region_id != '') {
        $query->whereHas('centre', function ($q) use ($request) {
            $q->where('region_id', $request->region_id);
        });
    }

    return DataTables::of($query)
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
            $validated = $request->validate([
                'participant_id' => 'required|exists:participants,id',
                'seance' => 'required|string',
                'montant' => 'required|numeric',
                'date_paiement' => 'required|date',
            ]);

            $participant->paiements()->create($validated);

            return redirect()->route('participants.index')->with('success', 'Paiement ajouté avec succès');
        }


    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nom et Prénom');
        $sheet->setCellValue('C1', 'Numéro CIN');
        $sheet->setCellValue('D1', 'Date de Naissance');
        $sheet->setCellValue('E1', 'Ville de Naissance');
        $sheet->setCellValue('F1', 'Adresse');
        $sheet->setCellValue('G1', 'Ville de Centre');
        $sheet->setCellValue('H1', 'Téléphone');
        $sheet->setCellValue('I1', 'Catégorie');
        $sheet->setCellValue('J1', 'Montant Inscription');
        $sheet->setCellValue('K1', 'Commercial');
        $sheet->setCellValue('L1', 'État');
        $sheet->setCellValue('M1', 'Reste');
        $sheet->setCellValue('N1', 'Centre');
        $sheet->setCellValue('O1', 'Créé le');
        $sheet->setCellValue('P1', 'Mis à jour le');

        $participants = Participant::with('centre')->get();
        $row = 2;

        foreach ($participants as $participant) {
            $sheet->setCellValue('A' . $row, $participant->id);
            $sheet->setCellValue('B' . $row, $participant->nom_prenom);
            $sheet->setCellValue('C' . $row, $participant->numero_cin);
            $sheet->setCellValue('D' . $row, $participant->date_naissance);
            $sheet->setCellValue('E' . $row, $participant->ville_naissance);
            $sheet->setCellValue('F' . $row, $participant->adresse);
            $sheet->setCellValue('G' . $row, $participant->ville_centre);
            $sheet->setCellValue('H' . $row, $participant->telephone);
            $sheet->setCellValue('I' . $row, $participant->categorie);
            $sheet->setCellValue('J' . $row, $participant->montant_inscription);
            $sheet->setCellValue('K' . $row, $participant->commercial);
            $sheet->setCellValue('L' . $row, $participant->etat);
            $sheet->setCellValue('M' . $row, $participant->reste);
            $sheet->setCellValue('N' . $row, $participant->centre->name ?? 'N/A');
            $sheet->setCellValue('O' . $row, $participant->created_at);
            $sheet->setCellValue('P' . $row, $participant->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'participants.xlsx';

        $response = new StreamedResponse(function() use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
    public function printDiplome(Participant $participant)
{
    return view('participants.diplome', compact('participant'));
}
}
