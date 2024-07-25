<!-- resources/views/role_permission/index.blade.php -->
@extends('layouts.app')

@section('title', 'Gestion des Rôles et Permissions')

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">
        <h2 class="my-4">Gestion des Rôles et Permissions</h2>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Utilisateurs</h4>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Ajouter Utilisateur</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôles</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($user->roles as $role)
                                            <li>{{ $role->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($user->permissions as $permission)
                                            <li>{{ $permission->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#manageRolesModal" data-user-id="{{ $user->id }}">Gérer Rôles</button>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#managePermissionsModal" data-user-id="{{ $user->id }}">Gérer Permissions</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal pour ajouter un utilisateur -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Ajouter Utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmer Mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select class="form-control" id="role" name="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    
    <!-- Modal pour gérer les rôles -->
    <div class="modal fade" id="manageRolesModal" tabindex="-1" aria-labelledby="manageRolesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="manageRolesForm" action="#" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageRolesModalLabel">Gérer Rôles</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select class="form-control" id="role" name="role">
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Assigner Rôle</button>
                        <button type="button" class="btn btn-danger" id="removeRoleButton">Retirer Rôle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal pour gérer les permissions -->
    <div class="modal fade" id="managePermissionsModal" tabindex="-1" aria-labelledby="managePermissionsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="managePermissionsForm" action="#" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="managePermissionsModalLabel">Gérer Permissions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="permission">Permission</label>
                            <select class="form-control" id="permission" name="permission">
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Donner Permission</button>
                        <button type="button" class="btn btn-danger" id="revokePermissionButton">Révoquer Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
$(document).ready(function() {
    // Set form action and handle role management
    $('#manageRolesModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var userId = button.data('user-id');
        var form = $('#manageRolesForm');
        form.attr('action', '/role-permissions/assign-role/' + userId);
        
        $('#removeRoleButton').click(function() {
            form.attr('action', '/role-permissions/remove-role/' + userId);
            form.submit();
        });
    });

    // Set form action and handle permission management
    $('#managePermissionsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var userId = button.data('user-id');
        var form = $('#managePermissionsForm');
        form.attr('action', '/role-permissions/give-permission/' + userId);
        
        $('#revokePermissionButton').click(function() {
            form.attr('action', '/role-permissions/revoke-permission/' + userId);
            form.submit();
        });
    });
});
</script>
@endsection
