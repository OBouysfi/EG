<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Centre;
use App\Models\Attestation;
use App\Models\Paiement;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = User::all();
        $regionsCount = Region::count();
        $centresCount = Centre::count();
        $participantsCount = Participant::count();
        $attestationsCount = Attestation::count();
        $activeParticipants = Participant::where('status', 'active')->count();
        $inactiveParticipants = Participant::where('status', 'inactive')->count();
        $totalParticipants = Participant::count();
        $totalCentres = Centre::count();

        $attestationsByRegion = [
            'Casablanca' => Attestation::whereHas('participant.centre.region', function ($query) {
                $query->where('name', 'Casablanca');
            })->count(),
            'Rabat' => Attestation::whereHas('participant.centre.region', function ($query) {
                $query->where('name', 'Rabat');
            })->count(),
            'Agadir' => Attestation::whereHas('participant.centre.region', function ($query) {
                $query->where('name', 'Agadir');
            })->count(),
            'Tanger' => Attestation::whereHas('participant.centre.region', function ($query) {
                $query->where('name', 'Tanger');
            })->count(),
        ];
    
        $participantsByRegion = [
            'Casablanca' => Participant::whereHas('centre.region', function ($query) {
                $query->where('name', 'Casablanca');
            })->count(),
            'Rabat' => Participant::whereHas('centre.region', function ($query) {
                $query->where('name', 'Rabat');
            })->count(),
            'Agadir' => Participant::whereHas('centre.region', function ($query) {
                $query->where('name', 'Agadir');
            })->count(),
            'Tanger' => Participant::whereHas('centre.region', function ($query) {
                $query->where('name', 'Tanger');
            })->count(),
        ];
    
        $recentPayments = Paiement::with('participant')->latest()->limit(5)->get();
    
        return view('dashboard', compact('regionsCount','centresCount','participantsCount','attestationsCount', 'activeParticipants', 'inactiveParticipants', 'totalParticipants', 'totalCentres', 'attestationsByRegion', 'participantsByRegion', 'recentPayments'));
    }
}
