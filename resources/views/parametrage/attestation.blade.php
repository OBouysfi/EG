<!-- resources/views/parametrage/attestation.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-wrapper">

            <div class="container-fluid">
             <div class="col-12">
              <div class="card">
        <h1>Attestation Page</h1>

        <div class="form-group mb-4">
            <label>Current Attestation Image:</label>
            <div>
                <img src="{{ asset('assets/img/attestation.png') }}" alt="Current Attestation Image" class="img-fluid" style="max-width: 200px;">
            </div>
        </div>

        <form action="{{ route('parametre.attestation.update_image') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Upload New Attestation Image:</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Image</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div> 
</div>
 </div> 
</div>
@endsection
