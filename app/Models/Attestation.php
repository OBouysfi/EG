<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attestation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['participant_id', 'date_delivrance'];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
