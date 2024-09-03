@extends('layouts.app')

@section('title', 'Mise à jour du logiciel')

@section('content')
    <div class="container">
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 text-dark">Mise à jour du logiciel</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Votre version</th>
                                        <td>{{ $currentVersion }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th scope="row">Dernière version</th>
                                        <td>{{ $latestVersion }}</td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <th scope="row">Code d'achat</th>
                                        <td>{{ $purchaseCode }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th scope="row">Date d'expiration du support</th>
                                        <td>{{ $supportExpiryDate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Version de PHP</th>
                                        <td>{{ $phpVersion }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Extension Zip</th>
                                        <td>
                                            <span class="badge badge-success">{{ $zipExtensionEnabled ? 'Activée' : 'Désactivée' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Extension cURL</th>
                                        <td>
                                            <span class="badge badge-success">{{ $curlExtensionEnabled ? 'Activée' : 'Désactivée' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" onclick="window.location.href='{{ route('support.contact') }}'">
                                <i class="fa fa-life-ring"></i> Contacter le support
                            </button>
                        </div>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function initiateUpdate() {
            alert('Mise à jour du logiciel en cours...');
            // Logique de mise à jour à implémenter ici
        }
    </script>
@endsection
