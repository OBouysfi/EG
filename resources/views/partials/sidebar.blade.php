<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Gestion</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="map-pin" class="feather-icon"></i>
                        <span class="hide-menu">Régions</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('regions.index')}}">
                                <span class="hide-menu">Liste des Régions</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('regions.create')}}">
                                <span class="hide-menu">Ajouter une Région</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="layers" class="feather-icon"></i>
                        <span class="hide-menu">Centres</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('centres.index')}}">
                                <span class="hide-menu">Liste des Centres</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('centres.create') }}">
                                <span class="hide-menu">Ajouter un Centre</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Participants</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('participants.index') }}">
                                <span class="hide-menu">Liste des Participants</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('participants.create') }}">
                                <span class="hide-menu">Ajouter un Participant</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="dollar-sign" class="feather-icon"></i>
                        <span class="hide-menu">Suivi Paiements</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('paiements.index') }}">
                                <span class="hide-menu">Liste des Paiements</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('paiements.create') }}">
                                <span class="hide-menu">Ajouter un Paiement</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- New Paramétrage Section -->
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Paramétrage</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('parametre.attestation') }}" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Attestation</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('parametre.diplome') }}" aria-expanded="false">
                        <i data-feather="file" class="feather-icon"></i>
                        <span class="hide-menu">Diplôme</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('software.update') }}" aria-expanded="false">
                        <i data-feather="refresh-cw" class="feather-icon"></i>
                        <span class="hide-menu">Mise à Jour Logicielle</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('support.contact') }}" aria-expanded="false">
                        <i data-feather="life-buoy" class="feather-icon"></i>
                        <span class="hide-menu">Support</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('backups.index') }}" aria-expanded="false">
                        <i data-feather="database" class="feather-icon"></i>
                        <span class="hide-menu">Backups</span>
                    </a>
                </li>
                
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>
                @if(auth()->user()->hasRole('super-admin'))
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('role_permissions.index') }}" aria-expanded="false">
                        <i data-feather="lock" class="feather-icon"></i>
                        <span class="hide-menu">Ajouter un administrateur</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('logout') }}" aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation-->
    </div>
    <!-- End Sidebar scroll-->
</aside>
