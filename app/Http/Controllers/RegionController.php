<?php

namespace App\Http\Controllers;

use App\Exports\RegionsExport;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Region;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
class RegionController extends Controller
{
    public function index()
    {
        return view('regions.listing');
    }

    public function data()
    {
        $regions = Region::select(['id', 'name']);

        return DataTables::of($regions)
            ->addColumn('actions', function ($region) {
                return '<div class="btn-group" role="group">' .
                       '<button type="button" class="btn btn-warning btn-sm me-3" onclick="editRegion(' . $region->id . ')">' .
                       '<i class="fa fa-edit"></i>Modifier</button>' .
                       '<button type="button" class="btn btn-danger btn-sm" onclick="deleteRegion(' . $region->id . ')">' .
                       '<i class="fa fa-trash"></i></button></div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(StoreRegionRequest $request)
    {
        Region::create($request->validated());

        return redirect()->route('regions.index')->with('success', 'Région ajoutée avec succès');
    }

    public function edit(Region $region)
    {
        return response()->json($region);
    }

    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->update($request->validated());

        return response()->json(['message' => 'Région mise à jour avec succès']);
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return response()->json(['message' => 'Région supprimée avec succès']);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nom');
        $sheet->setCellValue('C1', 'Créé le');
        $sheet->setCellValue('D1', 'Mis à jour le');

        $regions = Region::all();
        $row = 2;

        foreach ($regions as $region) {
            $sheet->setCellValue('A' . $row, $region->id);
            $sheet->setCellValue('B' . $row, $region->name);
            $sheet->setCellValue('C' . $row, $region->created_at);
            $sheet->setCellValue('D' . $row, $region->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'regions.xlsx';

        $response = new StreamedResponse(function() use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
