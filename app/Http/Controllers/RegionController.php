<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegionController extends Controller
{
    public function index()
    {
        return view('regions.listing');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Region::select(['id', 'name']);
            return DataTables::of($data)
                ->addColumn('actions', function ($region) {
                    // Your action column HTML
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    // Other methods...
}

