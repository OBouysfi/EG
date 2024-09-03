<!-- resources/views/licenses/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Licences</h1>
    <a href="{{ route('licenses.create') }}" class="btn btn-primary">Ajouter une Licence</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Date d'Expiration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($licenses as $license)
            <tr>
                <td>{{ $license->id }}</td>
                <td>{{ $license->type }}</td>
                <td>{{ $license->expires_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('licenses.edit', $license) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('licenses.destroy', $license) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
