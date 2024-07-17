<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'centre_id', 'nom_prenom', 'numero_cin', 'date_naissance', 'ville_naissance', 'adresse', 'ville_centre', 'telephone', 'categorie', 'montant_inscription', 'commercial', 'etat', 'reste'
    ];

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function diplomes()
    {
        return $this->hasMany(Diplome::class);
    }

    public function attestations()
    {
        return $this->hasMany(Attestation::class);
    }
}
