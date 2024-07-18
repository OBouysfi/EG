@extends('layouts.app')

@section('title' , 'Ajouter une région')
    
@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card" style="width: 100%; margin-top:10%;">
        <div class="card-header">
            <h4 class="text-dark">Ajouter une Région</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('regions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="text-dark fs-14">Nom de la Région</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3" style="border-radius: 10px; float:right;">Ajouter</button>
            </form>
        </div>
    </div>
</div>
@endsection
