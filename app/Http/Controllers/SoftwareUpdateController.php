<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use Illuminate\Support\Facades\Auth;

class SoftwareUpdateController extends Controller
{
    public function index()
    {
        // Récupérer la version actuelle du logiciel
        $currentVersion = config('app.version');

        // Simuler l'obtention de la dernière version depuis un service externe
        $latestVersion = '6.7.0';

        // Obtenez le code d'achat depuis le fichier de configuration ou base de données
        $purchaseCode = env('PURCHASE_CODE', 'Votre code d\'achat');

        // Récupérer la licence de l'utilisateur connecté
        $license = License::where('user_id', Auth::id())->first();

        // Si la licence existe, obtenir la date d'expiration du support
        $supportExpiryDate = $license ? $license->support_expiry_date : 'Non activé';

        // Récupérer la version actuelle de PHP
        $phpVersion = phpversion();

        // Vérifiez si les extensions sont activées
        $zipExtensionEnabled = extension_loaded('zip');
        $curlExtensionEnabled = extension_loaded('curl');

        return view('parametrage.software_update', compact(
            'currentVersion', 
            'latestVersion', 
            'purchaseCode', 
            'supportExpiryDate', 
            'phpVersion', 
            'zipExtensionEnabled', 
            'curlExtensionEnabled'
        ));
    }
}
