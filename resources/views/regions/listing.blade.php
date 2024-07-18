@extends('layouts.app')

@section('title', 'Régions')

<style>
    .btn-group-sm > .btn, .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: 1px;
        border-radius: 8px !important;
    }
    .btn-primary {
        background: #F99B0C !important;
        border: none !important;
        border-radius: 8px !important;
    }
    .btn-secondary {
        border-radius: 8px !important;
    }
    .table thead th {
        background-color: #003F54;
        color: #ffffff;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .table td {
        background-color: #ffffff;
    }
    .dataTables_filter input {
        background-color: #000;
        color: #fff;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 5px 10px;
    }
</style>

@section('content')
<div class="page-wrapper">

    <div class="container-fluid">
    <div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0 text-dark">Liste des Régions</h3>
            <div>
                <a href="{{ route('regions.create') }}" class="btn btn-primary" style="background: #004F6D !important;">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
                <button class="btn btn-secondary" style="background: #003F49;" onclick="window.location.href='{{ route('regions.export') }}'">
                    <i class="fa fa-download"></i> Télécharger
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="regions-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
   </div>
   </div>
  </div>
</div>
<!-- Modal pour modifier une région -->
<div class="modal fade" id="editRegionModal" tabindex="-1" aria-labelledby="editRegionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRegionModalLabel">Modifier la Région</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editRegionForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="regionName">Nom</label>
                        <input type="text" class="form-control" id="regionName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
$(document).ready(function() {
    var table = $('#regions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('regions.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, render: function(data, type, row) {
                return '<div class="btn-group" role="group">' +
                    '<button type="button" class="btn btn-warning text-white btn-sm mr-2" onclick="editRegion(' + row.id + ')">' +
                    '<i class="fa fa-edit mr-1"></i>Modifier</button>' +
                    '<button type="button" class="btn btn-danger btn-sm ml-2" onclick="deleteRegion(' + row.id + ')">' +
                    '<i class="fa fa-trash mr-1"></i>Supprimer</button></div>';

                }}
        ],
        language: {
            "emptyTable": "Aucune donnée disponible",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "infoEmpty": "Affichage de 0 à 0 sur 0 entrée",
            "infoFiltered": "(filtré à partir de _MAX_ entrées totales)",
            "lengthMenu": "Afficher _MENU_ entrées",
            "loadingRecords": "Chargement...",
            "processing": "Traitement...",
            "search": "",
            "searchPlaceholder": "Rechercher",
            "zeroRecords": "Aucun enregistrement correspondant trouvé",
            "paginate": {
                "first": "<<",
                "last": ">>",
                "next": ">",
                "previous": "<"
            },
            "aria": {
                "sortAscending": ": activer pour trier la colonne par ordre croissant",
                "sortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });

    $('#editRegionForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#editRegionModal').data('id');
        var name = $('#regionName').val();

        $.ajax({
            url: '/regions/' + id,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                name: name
            },
            success: function(response) {
                $('#editRegionModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: response.message,
                });
                table.ajax.reload();
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: response.responseJSON.message,
                });
            }
        });
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: "{{ session('success') }}",
        });
    @endif
});

function deleteRegion(regionId) {
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Vous ne pourrez pas revenir en arrière!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimez-le!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/regions/" + regionId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Supprimé!',
                        'La région a été supprimée.',
                        'success'
                    );
                    $('#regions-table').DataTable().ajax.reload();
                },
                error: function(response) {
                    Swal.fire(
                        'Erreur!',
                        'Une erreur est survenue.',
                        'error'
                    );
                }
            });
        }
    });
}

function editRegion(regionId) {
    $.ajax({
        url: '/regions/' + regionId + '/edit',
        type: 'GET',
        success: function(response) {
            $('#regionName').val(response.name);
            $('#editRegionModal').data('id', regionId).modal('show');
        },
        error: function(response) {
            Swal.fire(
                'Erreur!',
                'Impossible de récupérer les informations de la région.',
                'error'
            );
        }
    });
}
</script>
@endsection
