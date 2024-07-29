@extends('layouts.app')

@section('title', 'Liste des Paiements')

<style>
    .btn-group-sm > .btn, .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
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
    white-space: nowrap;
    border-right: 3px solid #ffffff;
    }
    .table thead tr {
        background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);
        color: #ffffff;
        white-space: nowrap;
    }
    .table thead th:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }
    .table thead th:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .table tbody td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
    @media print {
        body * {
            visibility: hidden;
        }
        #printableTable, #printableTable * {
            visibility: visible;
        }
        #printableTable {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
    #addToTable{
        background: none !important; 
        border: 1px solid #5f76e8 !important; 
        color: #5f76e8;
        border-radius: 20px !important;
    }
</style>

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 text-dark">Liste des Paiements</h3>
                        <div>
                            <a href="{{ route('paiements.create') }}" class="btn btn-primary" id="addToTable">
                                <i class="fa fa-plus"></i> Ajouter
                            </a>
                            <button class="btn btn-secondary" style="border-radius:20px !important; background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);">
                                <i class="fa fa-download"></i> Télécharger
                            </button>
                            <button id="printButton" class="btn btn-info" style="border-radius:20px; background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);">
                                <i class="fa fa-print"></i> Imprimer
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
            { data: 'participant', name: 'participant.nom_prenom' },
            { data: 'seance', name: 'seance' },
            { data: 'montant', name: 'montant' },
            { data: 'date_paiement', name: 'date_paiement' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, render: function(data, type, row) {
                return '<div class="btn-group" role="group">' +
                    '<button type="button" class="btn btn-warning text-white btn-sm mr-2" onclick="editPaiement(' + row.id + ')">' +
                    '<i class="fa fa-edit mr-1"></i>Modifier</button>' +
                    '<button type="button" class="btn btn-danger btn-sm ml-2" onclick="deletePaiement(' + row.id + ')">' +
                    '<i class="fa fa-trash mr-1"></i>Supprimer</button>' +
                '</div>';
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

   $('#printButton').on('click', function() {
    var css = `
        @page { size: auto; margin: 20mm; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 5px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #003F54; color: #fff; }
    `;

    var printWindow = window.open('', '', 'height=800,width=1100');
    printWindow.document.write('<html><head><title></title>');
    printWindow.document.write('<style>' + css + '</style>');
    printWindow.document.write('</head><body >');
    printWindow.document.write('<h3 class="mb-0 text-dark">Liste des Paiements</h3>');

    // Clone the table and remove unwanted elements
    var tableClone = $('#paiements-table').clone();
    tableClone.find('.dataTables_paginate, .dataTables_filter').remove();

    // Remove the actions column (assuming it's the last column)
    tableClone.find('thead th:last-child').remove();
    tableClone.find('tbody tr').each(function() {
        $(this).find('td:last-child').remove();
    });

    printWindow.document.write(tableClone.prop('outerHTML'));
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
});


$('#editPaiementForm').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(response)
        {
            $('#editPaiementModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: response.message,
            });
            $('#paiements-table').DataTable().ajax.reload();
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur est survenue lors de la mise à jour du paiement.',
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
            var seances = response.seances;

            // Populate the form fields
            $('#editPaiementForm #participant_id').empty();
            $.each(participants, function(index, participant) {
                $('#editPaiementForm #participant_id').append($('<option>', {
                    value: participant.id,
                    text: participant.nom_prenom
                }));
            });

            $('#editPaiementForm #participant_id').val(paiement.participant_id);
            $('#editPaiementForm #seance').val(paiement.seance);
            $('#editPaiementForm #montant').val(paiement.montant);
            $('#editPaiementForm #date_paiement').val(paiement.date_paiement);

            // Set the form action
            $('#editPaiementForm').attr('action', '/paiements/' + paiementId);

            // Show the modal
            $('#editPaiementModal').modal('show');
        },
        error: function(response) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur est survenue lors de la récupération des données du paiement.',
            });
        }
    });
}
</script>
@endsection
