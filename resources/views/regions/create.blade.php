@extends('layouts.app')

@section('title' , 'Ajouter une région')
    
@section('content')
<div class="page-wrapper">

    <div class="container-fluid">
    <div class="col-12">
<div class="card">
    <div class="card">
        <div class="card-header">
            <h1 class="mb-4">Ajouter une Région</h1>
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
</div>
</div>
</div>
</div>
@endsection
