<?php

namespace App\Services;

use App\Models\License;
use App\Models\User;
use Carbon\Carbon;

class LicenseService
{
    /**
     * Créer une licence d'essai pour un utilisateur.
     */
    public function createTrialLicense(User $user)
    {
        return License::create([
            'user_id' => $user->id,
            'type' => 'trial',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(15), // 15 jours d'essai
            'is_active' => true,
        ]);
    }

    /**
     * Créer une licence d'abonnement pour un utilisateur.
     */
    public function createSubscriptionLicense(User $user, $durationInMonths)
    {
        return License::create([
            'user_id' => $user->id,
            'type' => 'subscription',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths($durationInMonths),
            'is_active' => true,
        ]);
    }

    /**
     * Vérifier si l'utilisateur a une licence active.
     */
    public function hasActiveLicense(User $user)
    {
        return $user->licenses()
            ->where('is_active', true)
            ->where('end_date', '>=', Carbon::now())
            ->exists();
    }
}
