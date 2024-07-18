<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCentreRequest;
use App\Http\Requests\UpdateCentreRequest;
use DataTables;

class CentreController extends Controller
{
    // Méthode pour retourner la liste des centres pour DataTables
    public function data()
    {
        $data = Centre::with('region')->select('centres.*');

        return Datatables::of($data)
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
}
