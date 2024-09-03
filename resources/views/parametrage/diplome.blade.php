<!-- resources/views/parametrage/diplome.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Paramètres du Diplôme</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h4 class="text-dark">Image Actuelle du Diplôme</h4>
                            <img src="{{ asset('assets/img/diplome.jpg') }}" alt="Image Actuelle du Diplôme" class="img-thumbnail mt-3" style="max-width: 300px; border: 2px solid #f0f0f0;">
                        </div>

                        <form action="{{ route('parametre.diplome.update_image') }}" method="POST" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <div class="form-group">
                                <label for="image" class="font-weight-bold">Télécharger une Nouvelle Image de Diplôme</label>
                                <input type="file" name="image" id="image" class="form-control border-primary" required>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Mettre à Jour l'Image</button>
                            </div>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-3 text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div> 
            </div>
        </div> 
    </div> 
</div>
@endsection
