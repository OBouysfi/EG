@extends('layouts.app')

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
<div class="container" style="margin-top: 100px !important;">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0 text-dark">Liste des Paiements</h3>
            <div>
                <a href="{{ route('paiements.create') }}" class="btn btn-primary" style="background: #004F6D !important;">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
                <button class="btn btn-secondary" style="background: #003F49;">
                    <i class="fa fa-download"></i> Télécharger
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="paiements-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Participant</th>
                            <th scope="col">Séance</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Date de Paiement</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('paiements.edit')

@endsection

@section('js')
<script>
$(document).ready(function() {
    var table = $('#paiements-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('paiements.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'participant', name: 'participant' },
            { data: 'seance', name: 'seance' },
            { data: 'montant', name: 'montant' },
            { data: 'date_paiement', name: 'date_paiement' },
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
        }
    });

    $('#editPaiementForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#editPaiementModal').data('id');
        var formData = $(this).serialize();

        $.ajax({
            url: '/paiements/' + id,
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#editPaiementModal').modal('hide');
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

function deletePaiement(paiementId) {
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
                url: "/paiements/" + paiementId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Supprimé!',
                        'Le paiement a été supprimé.',
                        'success'
                    );
                    $('#paiements-table').DataTable().ajax.reload();
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

function editPaiement(paiementId) {
    $.ajax({
        url: '/paiements/' + paiementId + '/edit',
        type: 'GET',
        success: function(response) {
            var paiement = response.paiement;
            var participants = response.participants;
            var seances = ['S1', 'S2', 'S3', 'S4', 'Centre'];

            $('#editPaiementForm').find('input[name="montant"]').val(paiement.montant);
            $('#editPaiementForm').find('input[name="date_paiement"]').val(paiement.date_paiement);

            var participantSelect = $('#editPaiementForm').find('select[name="participant_id"]');
            participantSelect.empty();
            participants.forEach(function(participant) {
                participantSelect.append(new Option(participant.nom_prenom, participant.id));
            });
            participantSelect.val(paiement.participant_id);

            var seanceSelect = $('#editPaiementForm').find('select[name="seance"]');
            seanceSelect.empty();
            seances.forEach(function(seance) {
                seanceSelect.append(new Option(seance, seance));
            });
            seanceSelect.val(paiement.seance);

            $('#editPaiementModal').data('id', paiementId).modal('show');
        },
        error: function(response) {
            Swal.fire(
                'Erreur!',
                'Impossible de récupérer les informations du paiement.',
                'error'
            );
        }
    });
}
</script>
@endsection
