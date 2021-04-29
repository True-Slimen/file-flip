@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <div class="row">
        <div class="col-6">
            <h2>Gestion des rôles</h2>
        </div>
        <div class="col-6 text-right">
            <a class="btn my-3 custom-btn-secondary" href="/dashboard">Dashboard</a>
        </div>
    </div>
</section>
<section class="custom-card container mb-5 p-4">
    <div class="row">
        <div class="col-6 p-2">
            <div class="wrapper p-4 card">
                <h4>Assigner un role</h4>
                <form method="POST" action="/assign-role">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label">Nom du membre</label>

                        <div class="">
                        <select name="username" id="username" class="form-control @error('username') is-invalid @enderror" >
                            @foreach($users as $user)
                            <option value="{{ $user->id}}">{{ $user->firstname}} {{ $user->lastname}}</option>
                            @endforeach
                        </select>
            
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rolename" class="col-md-4 col-form-label">Nom du rôles</label>

                        <div class="">
                        <select name="rolename" id="rolename" class="form-control @error('rolename') is-invalid @enderror" >
                            @foreach($roles as $role)
                            <option value="{{ $loop->index }}">{{ $role }}</option>
                            @endforeach
                        </select>
            
                            @error('rolename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                            <button type="submit" class="ml-3 col-4 mr-auto btn custom-btn-secondary">
                                Assigner
                            </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6 p-2">
            <div class="wrapper p-4 card">
                <h4>Membre</h4>
                <ul>
                @foreach($roleslist as $role)
                    @if($role->type == 11)
                    <li>{{ $role->user->firstname }}</li>
                    @endif
                @endforeach
                </ul>
                <hr>
                <h4>Admin</h4>
                <ul>
                @foreach($roleslist as $role)
                    @if($role->type == 10)
                    <li>{{ $role->user->firstname }}</li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class=" mt-5 card modify-root-nav">
    <div class="row p-3">
        <div class="col-6 text-center">
            <button class="custom-btn-secondary">Creer un dossier ici</button>
        </div>
        <div class="col-6 text-center">
            <button class="custom-btn-secondary">Uploader un fichier ici</button>
        </div>
    </div>
</div>
</section>


@endsection