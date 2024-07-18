@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background: url('css/diplome.png') no-repeat center center fixed; background-size: cover;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: transparent; border: none;">
                <div class="card-body text-center">
                    <h1>Diplôme</h1>
                    <p>Nom complet: {{ $participant->nom_prenom }}</p>
                    <p>N° CIN: {{ $participant->numero_cin }}</p>
                    <p>Date de Naissance: {{ $participant->date_naissance }}</p>
                    <p>Ville de Naissance: {{ $participant->ville_naissance }}</p>
                    <p>Date Centre: {{ $participant->created_at->format('d/m/Y') }}</p>
                    <p>Nom de la formation: {{ $participant->formation }}</p>
                    <p>Catégorie: {{ $participant->categorie }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
