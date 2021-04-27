@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <div class="row">
        <div class="col-6">
            <h2>Gestion des groupes</h2>
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
                <h4>Créer un groupe</h4>
                <form method="POST" action="/edit-group">
                    @csrf
                    <div class="form-group row">
                        <label for="groupname" class="col-md-4 col-form-label">Nom du groupe</label>

                        <div class="">
                            <input id="groupname" type="text" class="form-control @error('groupname') is-invalid @enderror" name="groupname" value="{{ old('groupname') }}" required autocomplete="groupname" autofocus>

                            @error('groupname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                            <button type="submit" class="ml-3 col-4 mr-auto btn custom-btn-secondary">
                                Créer
                            </button>
                    </div>
                </form>
                <hr>
                <h4>Groupe existant</h4>
                <ul>
                    @foreach($members as $member)
                        <li><strong>{{ $member->group->name }}</strong></li>
                        Membre :
                        <ul>
                            
                            <li>{{ $member->user_id }}</li>
                        </ul>
                    @endforeach
                </ul>

            </div>
        </div>
        <div class="col-6 p-2">
            <div class="wrapper p-4 card">
                <h4>Assigner un membre</h4>
                <form method="POST" action="/assign-membre">
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
                        <label for="groupname" class="col-md-4 col-form-label">Nom du membre</label>

                        <div class="">
                        <select name="groupname" id="groupname" class="form-control @error('groupname') is-invalid @enderror" >
                            @foreach($groups as $group)
                            <option value="{{ $group->id}}">{{ $group->name}}</option>
                            @endforeach
                        </select>
            
                            @error('groupname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                            <button type="submit" class="ml-3 col-4 mr-auto btn custom-btn-secondary">
                                Créer
                            </button>
                    </div>
                </form>
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