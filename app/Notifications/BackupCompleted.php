<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BackupCompleted extends Notification
{
    use Queueable;

    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('Sauvegarde Terminée')
                    ->line('La sauvegarde a été créée avec succès.')
                    ->line('Nom du fichier : ' . $this->filename)
                    ->action('Télécharger la sauvegarde', url('/backups/download/' . $this->filename));
    }
}
