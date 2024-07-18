<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
            ->addColumn('actions', function($region) {
                return '<a href="' . route('regions.edit', $region->id) . '" class="btn btn-sm btn-primary">Modifier</a>
                        <button class="btn btn-sm btn-danger" onclick="deleteRegion(' . $region->id . ')">Supprimer</button>';
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
        $region = Region::create($request->validated());

        return redirect()->route('regions.index')->with('success', 'Région ajoutée avec succès.');
    }

    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $region->update([
            'name' => $request->name,
        ]);

        return redirect()->route('regions.index')->with('success', 'Région mise à jour avec succès!');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(['success' => 'Region deleted successfully']);
    }
}
