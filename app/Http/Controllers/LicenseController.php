<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\User;
use App\Services\LicenseService;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    protected $licenseService;

    public function __construct(LicenseService $licenseService)
    {
        $this->licenseService = $licenseService;
    }

    /**
     * Affiche la liste des licences.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $licenses = License::with('user')->get();
        return view('licenses.index', compact('licenses'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle licence.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        return view('licenses.create', compact('users'));
    }

    /**
     * Enregistre une nouvelle licence dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $this->licenseService->createLicense($request->all());

        return redirect()->route('licenses.index')->with('success', 'Licence créée avec succès.');
    }

    /**
     * Affiche les détails d'une licence spécifique.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $license = License::with('user')->findOrFail($id);
        return view('licenses.show', compact('license'));
    }

    /**
     * Affiche le formulaire d'édition d'une licence.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $license = License::findOrFail($id);
        $users = User::all();
        return view('licenses.edit', compact('license', 'users'));
    }

    /**
     * Met à jour une licence dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $this->licenseService->updateLicense($id, $request->all());

        return redirect()->route('licenses.index')->with('success', 'Licence mise à jour avec succès.');
    }

    /**
     * Supprime une licence de la base de données.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->licenseService->deleteLicense($id);

        return redirect()->route('licenses.index')->with('success', 'Licence supprimée avec succès.');
    }
}
