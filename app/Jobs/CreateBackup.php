<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Notifications\BackupCompleted;
use Illuminate\Support\Facades\Notification;

class CreateBackup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Générer un nom de fichier avec la date et l'heure
        $filename = 'backup_' . Carbon::now()->format('Y_m_d_His') . '.sql';

        // Créer la sauvegarde
        Artisan::call('db:backup', [
            '--destination' => 'local',
            '--destinationPath' => "backups/{$filename}",
            '--compression' => 'gzip'
        ]);

        // Envoyer une notification une fois la sauvegarde terminée
        Notification::route('mail', 'support@continuum.ma')
            ->notify(new BackupCompleted($filename));
    }
}
