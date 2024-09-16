@extends('layouts.app')

@section('content')


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Database Backups</h4>
                <form action="{{ route('backups.create') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-database"></i> Backup Now
                    </button>
                </form>
            </div>
            <div class="card-body">
                <p class="card-text">Recent database backups.</p>
    
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
    
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Backed up since</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backups as $backup)
                            <tr>
                                <td>
                                    <i class="fas fa-file-archive"></i> {{ $backup['file_name'] }}
                                </td>
                                <td>{{ $backup['last_modified'] }}</td>
                                <td>
                                    <a href="{{ route('backups.download', $backup['file_name']) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    <form action="{{ route('backups.delete', $backup['file_name']) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No backups found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
