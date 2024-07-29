<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand"> 
                <!-- Logo icon -->
                <a href="{{ route('dashboard') }}">
                    <b class="logo-icon mx-3">
                        <!-- Dark Logo icon -->
                        <img src="{{ asset('assets/images/logo-icon.png') }}" alt="dashboard" class="dark-logo mx-5" />
                        <!-- Light Logo icon -->
                        <img src="{{ asset('assets/images/logo-icon.png') }}" alt="dashboard" class="light-logo mx-5" />
                    </b>
                </a>
            </div>
            
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav ml-auto">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    @php
                        $user = Auth::user();
                    @endphp
                
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('assets/images/users/img.png') }}" 
                             alt="" class="rounded-circle" width="50" height="50">
                        <span class="text-dark">{{ $user->name }}</span>
                        <i data-feather="chevron-down" class="svg-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="">
                            <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                            Mon Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="">
                            <i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                            Paramètres du Compte
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                            Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
