@extends('layouts.app')

@section('content')
<style>
    footer{bottom: auto;}
</style>
<div class="container section-top mb-5">
    <div class="row">
        <h1>Créer un utilisateur</h1>
        <div class="card mx-auto p-4 col-6">

                    <form method="POST" action="/send-new-user">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class=" col-form-label">{{ __('Prénom') }}</label>

                            <div class="">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class=" col-form-label">{{ __('Nom') }}</label>

                            <div class="">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class=" col-form-label">{{ __('E-Mail') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class=" col-form-label">{{ __('Mot de passe') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class=" col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        @if(config('settings.reCaptchStatus'))
                            <div class="form-group">
                                <div class="col-sm-offset-4">
                                    <div class="g-recaptcha" data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                                </div>
                            </div>
                        @endif

  
                                <button type="submit" class="btn col-4 custom-btn-secondary">
                                    Créer
                                </button>
                                <a  href="/ged/root" class="custom-btn-secondary mt-3" >Annuler</a> 

                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
