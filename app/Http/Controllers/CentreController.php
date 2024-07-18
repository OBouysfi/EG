<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCentreRequest;
use App\Http\Requests\UpdateCentreRequest;
use DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class CentreController extends Controller
{
    // Méthode pour retourner la liste des centres pour DataTables
    public function data()
    {
        $data = Centre::with('region')->select('centres.*');

        return FacadesDataTables::of($data)
            ->addColumn('actions', function($row){
                $btn = '<a href="javascript:void(0)" onclick="editCentre('.$row->id.')" class="edit btn btn-primary btn-sm">Modifier</a>';
                $btn .= ' <a href="javascript:void(0)" onclick="deleteCentre('.$row->id.')" class="delete btn btn-danger btn-sm">Supprimer</a>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function index()
    {
        $regions = Region::all();
        return view('centres.listing', compact('regions'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('centres.create', compact('regions'));
    }

    public function store(StoreCentreRequest $request)
    {
        Centre::create($request->validated());

        return redirect()->route('centres.index')->with('success', 'Centre created successfully.');
    }

    public function edit(Centre $centre)
    {
        return response()->json($centre);
    }

    public function update(UpdateCentreRequest $request, Centre $centre)
    {
        $centre->update($request->validated());

        return response()->json(['message' => 'Centre updated successfully.']);
    }

    public function destroy(Centre $centre)
    {
        $centre->delete();

        return response()->json(['message' => 'Centre deleted successfully.']);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nom');
        $sheet->setCellValue('C1', 'Région');
        $sheet->setCellValue('D1', 'Créé le');
        $sheet->setCellValue('E1', 'Mis à jour le');

        $centres = Centre::with('region')->get();
        $row = 2;

        foreach ($centres as $centre) {
            $sheet->setCellValue('A' . $row, $centre->id);
            $sheet->setCellValue('B' . $row, $centre->name);
            $sheet->setCellValue('C' . $row, $centre->region->name);
            $sheet->setCellValue('D' . $row, $centre->created_at);
            $sheet->setCellValue('E' . $row, $centre->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'centres.xlsx';

        $response = new StreamedResponse(function() use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
