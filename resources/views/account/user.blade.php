@extends('layouts.app')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- style css for this template -->
    <link href="{{ asset('assets_custom/scss/style.css') }}" rel="stylesheet">
    <title>Mon Profile</title>
    @section('content')
    <main class="main mainheight">
        <div class="container">
            <div class="col-10 float-right">
                  <ul class="nav nav-tabs justify-content-center nav-adminux nav-lg" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                    </li>
                </ul>
                
                <div class="tab-content py-3" id="myTabContent">
                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h6 class="title">Mon profile</h6>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center align-items-center mb-4">
                                <!-- ... (keep the existing avatar upload section) ... -->
                                
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group my-2 position-relative check-valid">
                                        <div class="form-floating">
                                            <input type="text" name="name" placeholder="Nom & Prénom" value="{{ Auth::user()->name }}" class="form-control" required>
                                            <label>Nom</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un nom valide</div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group my-2 position-relative check-valid">
                                        <div class="form-floating">
                                            <input type="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}" class="form-control" required>
                                            <label>Email</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Veuillez entrer un email valide</div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group my-2 position-relative">
                                        <div class="form-floating">
                                            <input id="password" type="password" name="password" placeholder="Mot de passe" class="form-control">
                                            <label for="password">Mot de passe</label>
                                            <span id="togglePassword" class="position-absolute end-0 top-30 translate-middle-y me-3">
                                                <i id="passwordIcon" class="bi bi-eye"></i>
                                            </span>
                                        </div>
                                  
                            
                                <div class="invalid-feedback">Entrer un mot de passe valide s'il vous plait</div>
                            </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Modifer</button>
                                </div>
                                @if(session('success'))
                             <div class="alert alert-success">
                               {{ session('success') }}
                             </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const passwordIcon = document.getElementById('passwordIcon');
    
        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
    
            // Toggle the eye icon
            if (type === 'password') {
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            } else {
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            }
        });
    });
    </script>
<!-- Required jquery and libraries -->
<script src="{{asset('assets_custom/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets_custom/js/popper.min.js')}}"></script>
<script src="{{asset('assets_custom/vendor/bootstrap-5/dist/js/bootstrap.bundle.js')}}"></script>

<!-- Customized jquery file  -->
<script src="{{asset('assets_custom/js/main.js')}}"></script>
<script src="{{asset('assets_custom/js/color-scheme.js')}}"></script>

<!-- PWA app service registration and works -->
<script src="{{asset('assets_custom/js/pwa-services.js')}}"></script>

@endsection