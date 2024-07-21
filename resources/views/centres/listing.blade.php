@extends('layouts.app')

@section('title', 'Centres')
    
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
        padding: 5px 15px;
    }
</style>

@section('content')

    <div class="page-wrapper">

        <div class="container-fluid">
        <div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0 text-dark">Liste des Centres</h3>
            <div>
                <a href="{{ route('centres.create') }}" class="btn btn-primary" style="background: #004F6D !important;">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
                <button class="btn btn-secondary" style="background: #003F49;" onclick="window.location.href='{{ route('centres.export') }}'">
                    <i class="fa fa-download"></i> Télécharger
                </button>
                <button class="btn btn-info" style="background: #006064;" onclick="printTable()">
                    <i class="fa fa-print"></i> Imprimer
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="centres-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Région</th>
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

<!-- Modal pour modifier un centre -->
@include('centres.edit')


@endsection

@section('js')
<script>
$(document).ready(function() {
    var table = $('#centres-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('centres.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'region.name', name: 'region.name' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
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
        },
    layout: {
        topStart: {
            buttons: ['Imprimer']
        }
    }
    });

    // Handle form submission for editing a centre
    $('#editCentreForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#editCentreModal').data('id');
        var name = $('#centreName').val();
        var region_id = $('#centreRegion').val();

        $.ajax({
            url: '/centres/' + id,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                region_id: region_id
            },
            success: function(response) {
                $('#editCentreModal').modal('hide');
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

    // Display SweetAlert on successful centre update
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: "{{ session('success') }}",
        });
    @endif
});

// Function to delete a centre
function deleteCentre(centreId) {
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
                url: "/centres/" + centreId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Supprimé!',
                        'Le centre a été supprimé.',
                        'success'
                    );
                    $('#centres-table').DataTable().ajax.reload();
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

// Function to open edit modal and populate data
function editCentre(centreId) {
    $.ajax({
        url: '/centres/' + centreId + '/edit',
        type: 'GET',
        success: function(response) {
            $('#centreName').val(response.name);
            $('#centreRegion').val(response.region_id);
            $('#editCentreModal').data('id', centreId).modal('show');
        },
        error: function(response) {
            Swal.fire(
                'Erreur!',
                'Impossible de récupérer les informations du centre.',
                'error'
            );
        }
    });
}
</script>
@endsection
