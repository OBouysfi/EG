<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
}
