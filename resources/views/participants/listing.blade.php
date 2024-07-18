@extends('layouts.app')


@section('title', 'Liste des Participants')
    
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
            <h3 class="mb-0 text-dark">Liste des Participants</h3>
            <div>
                <a href="{{ route('participants.create') }}" class="btn btn-primary" style="background: #004F6D !important;">
                    <i class="fa fa-plus"></i> Ajouter
                </a>
                <button class="btn btn-secondary" style="background: #003F49;" onclick="window.location.href='{{ route('participants.export') }}'">
                    <i class="fa fa-download"></i> Télécharger
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="participants-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom et Prénom</th>
                            <th scope="col">Numéro CIN</th>
                            <th scope="col">Date de Naissance</th>
                            <th scope="col">Ville de Naissance</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Ville de Centre</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Montant Inscription</th>
                            <th scope="col">Commercial</th>
                            <th scope="col">État</th>
                            <th scope="col">Reste</th>
                            <th scope="col">Centre</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('participants.edit')
@include('participants.paiement')

@endsection

@section('js')
<script>
$(document).ready(function() {
    var table = $('#participants-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('participants.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom_prenom', name: 'nom_prenom' },
            { data: 'numero_cin', name: 'numero_cin' },
            { data: 'date_naissance', name: 'date_naissance' },
            { data: 'ville_naissance', name: 'ville_naissance' },
            { data: 'adresse', name: 'adresse' },
            { data: 'ville_centre', name: 'ville_centre' },
            { data: 'telephone', name: 'telephone' },
            { data: 'categorie', name: 'categorie' },
            { data: 'montant_inscription', name: 'montant_inscription' },
            { data: 'commercial', name: 'commercial' },
            { data: 'etat', name: 'etat' },
            { data: 'reste', name: 'reste' },
            { data: 'centre', name: 'centre' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, render: function(data, type, row) {
                return '<div class="btn-group" role="group">' +
                    '<button type="button" class="btn btn-warning btn-sm" onclick="editParticipant(' + row.id + ')">' +
                    '<i class="fa fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deleteParticipant(' + row.id + ')">' +
                    '<i class="fa fa-trash"></i></button>' +
                    '<button type="button" class="btn btn-success btn-sm" onclick="addPaiement(' + row.id + ')">' +
                    '<i class="fa fa-dollar-sign"></i></button></div>';
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

    $('#editParticipantForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#editParticipantModal').data('id');
        var formData = $(this).serialize();

        $.ajax({
            url: '/participants/' + id,
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#editParticipantModal').modal('hide');
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

function deleteParticipant(participantId) {
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
                url: "/participants/" + participantId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Supprimé!',
                        'Le participant a été supprimé.',
                        'success'
                    );
                    $('#participants-table').DataTable().ajax.reload();
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

function editParticipant(participantId) {
    $.ajax({
        url: '/participants/' + participantId + '/edit',
        type: 'GET',
        success: function(response) {
            var participant = response.participant;
            var centres = response.centres;

            $('#editParticipantForm').find('input[name="nom_prenom"]').val(participant.nom_prenom);
            $('#editParticipantForm').find('input[name="numero_cin"]').val(participant.numero_cin);
            $('#editParticipantForm').find('input[name="date_naissance"]').val(participant.date_naissance);
            $('#editParticipantForm').find('input[name="ville_naissance"]').val(participant.ville_naissance);
            $('#editParticipantForm').find('input[name="adresse"]').val(participant.adresse);
            $('#editParticipantForm').find('input[name="ville_centre"]').val(participant.ville_centre);
            $('#editParticipantForm').find('input[name="telephone"]').val(participant.telephone);
            $('#editParticipantForm').find('input[name="categorie"]').val(participant.categorie);
            $('#editParticipantForm').find('input[name="montant_inscription"]').val(participant.montant_inscription);
            $('#editParticipantForm').find('input[name="commercial"]').val(participant.commercial);
            $('#editParticipantForm').find('input[name="etat"]').val(participant.etat);
            $('#editParticipantForm').find('input[name="reste"]').val(participant.reste);

            var centreSelect = $('#editParticipantForm').find('select[name="centre_id"]');
            centreSelect.empty();
            centres.forEach(function(centre) {
                centreSelect.append(new Option(centre.name, centre.id));
            });
            centreSelect.val(participant.centre_id);

            $('#editParticipantModal').data('id', participantId).modal('show');
        },
        error: function(response) {
            Swal.fire(
                'Erreur!',
                'Impossible de récupérer les informations du participant.',
                'error'
            );
        }
    });
}

function addPayment(participantId) {
    $('#addPaymentForm').find('input[name="participant_id"]').val(participantId);
    $('#addPaymentModal').modal('show');
}
</script>
@endsection
