@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  
    <div class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
@php
    $user = Auth::user();
    $firstName = explode(' ', $user->name)[0];
@endphp

                   <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Bienvenue {{ $firstName }}!</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-5 align-self-center">
                    <div class="customize-input float-right">
                        <select
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <option selected>Aug 19</option>
                            <option value="1">July 19</option>
                            <option value="2">Jun 19</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- *************************************************************** -->
            <!-- Start First Cards -->
            <!-- *************************************************************** -->
            <div class="card-group">
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $regionsCount }}</h2>
                                    <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Regions</span>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Nombre de Régions</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="map"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $centresCount }}</h2>
                                    <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Centres</span>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Nombre de Centres</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="home"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $participantsCount }}</h2>
                                    <span class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">Participants</span>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Nombre de Participants</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="users"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $attestationsCount }}</h2>
                                    <span class="badge bg-success font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Attestations</span>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Attestations Générées</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="file-text"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">

                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Total Participants</h4>
                            <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                            <ul class="list-style-none mb-0">
                                <li>
                                    <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                    <span class="text-muted">Active Participants</span>
                                    <span class="text-dark float-right font-weight-medium">{{ $activeParticipants }}</span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                    <span class="text-muted">Inactive Participants</span>
                                    <span class="text-dark float-right font-weight-medium">{{ $inactiveParticipants }}</span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                    <span class="text-muted">Total Participants</span>
                                    <span class="text-dark float-right font-weight-medium">{{ $totalParticipants }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
              
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Centres et Participants</h4>
                            <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                            <ul class="list-inline text-center mt-5 mb-2">
                                <li class="list-inline-item text-muted font-italic">Nombre de centres et de participants cette année
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Participants par Région</h4>
                            <div class="" style="height:180px">
                                <div id="visitbylocate" style="height:100%"></div>
                            </div>
                            <div class="row mb-3 align-items-center mt-1 mt-5">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">Casablanca</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                            aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">Rabat</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 74%" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">Agadir</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">Tanger</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *************************************************************** -->
            <!-- End Sales Charts Section -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
            <!-- Start Location and Earnings Charts Section -->
            <!-- *************************************************************** -->
            <div class="row">
                <!-- Earning Statistics (Suivi des Paiements) -->
                <div class="col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <h4 class="card-title mb-0">Suivi des Paiements</h4>
                            </div>
                            <div class="pl-4 mb-5">
                                <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                            </div>
                            <ul class="list-inline text-center mt-4 mb-0">
                                <li class="list-inline-item text-muted font-italic">Paiements pour ce mois</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Recent Activity (Activité Récentes) -->
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Activité Récentes</h4>
                            <div class="mt-4 activity">
                                @if($recentPayments->isEmpty())
                                    <p class="text-muted">Aucune activité récente.</p>
                                @else
                                    @foreach ($recentPayments as $payment)
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                    <i data-feather="shopping-cart"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">{{ $payment->participant->name }}</h5>
                                                <p class="font-14 mb-2 text-muted">{{ $payment->amount }} MAD payé le {{ $payment->date ? $payment->date->format('d/m/Y') : 'N/A' }}</p>
                                                <span class="font-weight-light font-14 text-muted">{{ $payment->date ? $payment->date->diffForHumans() : 'Date inconnue' }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
          
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="card-title">Top Leaders</h4>
                                <div class="ml-auto">
                                    <div class="dropdown sub-dropdown">
                                        <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                            <a class="dropdown-item" href="#">Insert</a>
                                            <a class="dropdown-item" href="#">Update</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap v-middle mb-0">
                                    <thead>
                                        <tr class="border-0">
                                            <th class="border-0 font-14 font-weight-medium text-muted">Team Lead
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted px-2">Project
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted">Team</th>
                                            <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                Status
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                Weeks
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted">Budget</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-top-0 px-2 py-4">
                                                <div class="d-flex no-block align-items-center">
                                                    <div class="mr-3"><img
                                                            src="{{ asset('assets/images/users/widget-table-pic1.jpg') }}"
                                                            alt="user" class="rounded-circle" width="45" height="45" />
                                                    </div>
                                                    <div class="">
                                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">Hanna
                                                            Gover</h5>
                                                        <span class="text-muted font-14">hgover@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-top-0 text-muted px-2 py-4 font-14">Elite Admin</td>
                                            <td class="border-top-0 px-2 py-4">
                                                <div class="popover-icon">
                                                    <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                        href="javascript:void(0)">DS</a>
                                                    <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                        href="javascript:void(0)">SS</a>
                                                    <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                                        href="javascript:void(0)">RP</a>
                                                    <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                        href="javascript:void(0)">+</a>
                                                </div>
                                            </td>
                                            <td class="border-top-0 text-center px-2 py-4"><i
                                                    class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                                    data-placement="top" title="In Testing"></i></td>
                                            <td
                                                class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                35
                                            </td>
                                            <td class="font-weight-medium text-dark border-top-0 px-2 py-4">$96K
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-2 py-4">
                                                <div class="d-flex no-block align-items-center">
                                                    <div class="mr-3"><img
                                                            src="{{ asset('assets/images/users/widget-table-pic2.jpg') }}"
                                                            alt="user" class="rounded-circle" width="45" height="45" />
                                                    </div>
                                                    <div class="">
                                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">Daniel
                                                            Kristeen
                                                        </h5>
                                                        <span class="text-muted font-14">Kristeen@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted px-2 py-4 font-14">Real Homes WP Theme</td>
                                            <td class="px-2 py-4">
                                                <div class="popover-icon">
                                                    <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                        href="javascript:void(0)">DS</a>
                                                    <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                        href="javascript:void(0)">SS</a>
                                                    <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                        href="javascript:void(0)">+</a>
                                                </div>
                                            </td>
                                            <td class="text-center px-2 py-4"><i
                                                    class="fa fa-circle text-success font-12" data-toggle="tooltip"
                                                    data-placement="top" title="Done"></i>
                                            </td>
                                            <td class="text-center text-muted font-weight-medium px-2 py-4">32</td>
                                            <td class="font-weight-medium text-dark px-2 py-4">$85K</td>
                                        </tr>
                                        <tr>
                                            <td class="px-2 py-4">
                                                <div class="d-flex no-block align-items-center">
                                                    <div class="mr-3"><img
                                                            src="{{ asset('assets/images/users/widget-table-pic3.jpg') }}"
                                                            alt="user" class="rounded-circle" width="45" height="45" />
                                                    </div>
                                                    <div class="">
                                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">Julian
                                                            Josephs
                                                        </h5>
                                                        <span class="text-muted font-14">Josephs@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted px-2 py-4 font-14">MedicalPro WP Theme</td>
                                            <td class="px-2 py-4">
                                                <div class="popover-icon">
                                                    <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                        href="javascript:void(0)">DS</a>
                                                    <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                        href="javascript:void(0)">SS</a>
                                                    <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                                        href="javascript:void(0)">RP</a>
                                                    <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                        href="javascript:void(0)">+</a>
                                                </div>
                                            </td>
                                            <td class="text-center px-2 py-4"><i
                                                    class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                                    data-placement="top" title="Done"></i>
                                            </td>
                                            <td class="text-center text-muted font-weight-medium px-2 py-4">29</td>
                                            <td class="font-weight-medium text-dark px-2 py-4">$81K</td>
                                        </tr>
                                        <tr>
                                            <td class="px-2 py-4">
                                                <div class="d-flex no-block align-items-center">
                                                    <div class="mr-3"><img
                                                            src="{{ asset('assets/images/users/widget-table-pic4.jpg') }}"
                                                            alt="user" class="rounded-circle" width="45" height="45" />
                                                    </div>
                                                    <div class="">
                                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">Jan
                                                            Petrovic
                                                        </h5>
                                                        <span class="text-muted font-14">hgover@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted px-2 py-4 font-14">Hosting Press HTML</td>
                                            <td class="px-2 py-4">
                                                <div class="popover-icon">
                                                    <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                        href="javascript:void(0)">DS</a>
                                                    <a class="btn btn-success text-white font-20 rounded-circle btn-circle"
                                                        href="javascript:void(0)">+</a>
                                                </div>
                                            </td>
                                            <td class="text-center px-2 py-4"><i
                                                    class="fa fa-circle text-danger font-12" data-toggle="tooltip"
                                                    data-placement="top" title="In Progress"></i></td>
                                            <td class="text-center text-muted font-weight-medium px-2 py-4">23</td>
                                            <td class="font-weight-medium text-dark px-2 py-4">$80K</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
       
        @include('partials.footer')
    </div>

@endsection
