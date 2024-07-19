<!-- resources/views/centres/create.blade.php -->
@extends('layouts.app')
<title>Ajouter Centre</title>
@section('content')

<div class="page-wrapper">

    <div class="container-fluid">
    <div class="col-12">
<div class="card">
    <h1 class="mb-4">Ajouter un Centre</h1>
    <form action="{{ route('centres.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom du Centre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="region_id">Région</label>
            <select class="form-control" id="region_id" name="region_id" required>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
</div>
</div>
</div>
@endsection
