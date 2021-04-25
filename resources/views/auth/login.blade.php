@extends('layouts.app')

@section('content')
<div class="container section-top mb-5">
    <div class="row">
            <h1>Se connecter</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, doloremque dolores doloribus culpa id debitis sed veniam? Nam numquam, assumenda enim unde ex blanditiis ducimus, sit nostrum est soluta repudiandae.</p>
            <div class="card col-6 p-3 mx-auto">
                
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">Email</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label">Mot de passe</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                                <button type="submit" class="ml-3 col-4 mr-auto btn custom-btn-secondary">
                                   Se connecter
                                </button>
                        </div>
                    </form>
            </div>
    </div>
</div>
@endsection
