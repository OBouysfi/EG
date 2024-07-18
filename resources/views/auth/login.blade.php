@extends('layouts.app_auth')



@section('title',"Se Connecter") 
@section('content')
    
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url({{asset('assets/images/big/3.jpg')}});">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                      
                        <h3 class="mt-3 text-center text-dark">Espace Administrateur</h3>
                        <form class="mt-4" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="email">Identifiant</label>
                                        <input class="form-control" id="email" name="email" type="text"       >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="password">Mot de passe</label>
                                        <input class="form-control" id="password" name="password" type="password" >
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Se Connecter</button>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
   
    @endsection

