<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Jobs\CreateBackup;
use App\Notifications\BackupCompleted;

class BackupController extends Controller
{
    public function index()
    {
        // Liste des fichiers de sauvegarde
        $backups = Storage::allFiles('backups');
        return view('backup.index', compact('backups'));
    }

    public function create()
    {
        // Dispatch un job pour créer la sauvegarde
        CreateBackup::dispatch();
        return redirect()->route('backups.index')->with('success', 'La sauvegarde est en cours de création.');
    }

   
    public function download($file_name)
    {
        $file_path = storage_path('app/backups/' . $file_name);
    
        if (file_exists($file_path)) {
            return response()->download($file_path);
        } else {
            return redirect()->back()->with('error', 'Backup file not found.');
        }
    }
    
    public function destroy($file)
    {
        // Supprimer le fichier de sauvegarde
        Storage::delete("backups/{$file}");
        return redirect()->route('backups.index')->with('success', 'La sauvegarde a été supprimée.');
    }
}
