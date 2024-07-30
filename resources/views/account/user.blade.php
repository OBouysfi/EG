@extends('layouts.app')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- style css for this template -->
    <link href="{{ asset('assets_custom/scss/style.css') }}" rel="stylesheet">

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
    
                    <!-- profile tab-->
                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h6 class="title">Mon profile</h6>
                        <div class="row justify-content-center align-items-center mb-4">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-100 text-center rounded">
                                            <img src="{{asset('assets/images/users/img.png')}}" alt="" class="mw-100"
                                                id="companylogolight" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label for="companylogolightinput" class="form-label">Télécharger la photo </label><br>
                                            <input class="form-control d-none" accept="image/*" type="file"
                                                id="companylogolightinput">
                                            <button class="btn btn-theme" onclick="$(this).prev().click()"><i
                                                    class="bi bi-camera"></i> Télécharger</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group my-2 position-relative check-valid">
                                    <div class="form-floating">
                                        <input type="text" placeholder="Nom & Prénom" value="{{ Auth::user()->name }}" disabled class="form-control">
                                        <label>Nom</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please enter valid input</div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group my-2 position-relative check-valid">
                                    <div class="form-floating">
                                        <input type="text" placeholder="Email" value="{{ Auth::user()->email }}" disabled
                                            class="form-control">
                                        <label>Email</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please enter valid input</div>
                            </div>
                        </div>
                        {{-- <h6 class="title">Profile details</h6>
                        <div class=" row mb-3">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group mb-3 position-relative check-valid">
                                    <div class="form-floating">
                                        <input type="text" placeholder="UserName" value="Maxartkiller" required
                                            class="form-control border-start-0">
                                        <label>UserName</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please enter valid input</div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-8">
                                <div class="form-group mb-3 position-relative check-valid">
                                    <div class="form-floating">
                                        <input type="text" placeholder="Tagline" value="" required
                                            class="form-control border-start-0">
                                        <label>Tagline</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please enter valid input</div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3 position-relative check-valid">
                                    <div class="form-floating">
                                        <input type="text" placeholder="Headline" value="" required
                                            class="form-control border-start-0">
                                        <label>Headline</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please enter valid input</div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3 position-relative check-valid">
                                    <div class="form-floating">
                                        <textarea placeholder="About me" rows="5"
                                            class="form-control border-start-0 h-auto"></textarea>
                                        <label>About me</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please enter valid input</div>
                            </div>
                        </div>
                        <h6 class="title">Public Visibility</h6>
                        <div class="row mb-4">
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="profileswitch1" checked>
                                    <label class="form-check-label" for="profileswitch1">Show my profile publicly</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="profileswitch2" checked>
                                    <label class="form-check-label" for="profileswitch2">Show my availability</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="profileswitch3">
                                    <label class="form-check-label" for="profileswitch3">Show tagline in profile</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="profileswitch4">
                                    <label class="form-check-label" for="profileswitch4">Make profile inactive</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col">
                                <!-- submit button -->
                                <button class="btn btn-theme" type="button">Submit</button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-white" type="button">Modifier</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection

@section('js')
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