@extends('layouts.app')

@section('content')
   <div class="page-wrapper">
    <div class="container-fluid" style="margin-top: 70px; color:black;">
        <h1>Contactez le Support</h1>
        <p>Pour toute assistance, veuillez remplir le formulaire ci-dessous ou nous envoyer un e-mail à support@continuum.ma</p>

        <!-- Affichage du message de succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Formulaire de contact -->
        <form action="{{ route('support.send') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
   </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
