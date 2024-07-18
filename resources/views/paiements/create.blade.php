@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0 text-dark">Ajouter un Paiement</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('paiements.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="participant_id">Participant</label>
                    <select name="participant_id" class="form-control" required>
                        @foreach($participants as $participant)
                            <option value="{{ $participant->id }}">{{ $participant->nom_prenom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="seance">Séance</label>
                    <select name="seance" class="form-control" required>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="S4">S4</option>
                        <option value="Centre">Centre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <input type="number" step="0.01" name="montant" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date_paiement">Date de Paiement</label>
                    <input type="date" name="date_paiement" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</div>
@endsection
