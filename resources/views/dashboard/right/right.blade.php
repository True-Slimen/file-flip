@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <div class="row">
        <div class="col-6">
            <h2>Gestion des droits</h2>
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
                <h4>Assigner un droit à un fichier</h4>
                <form method="POST" action="/assign-right-file">
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
                        <label for="rightname" class="col-md-4 col-form-label">Nom du droit</label>

                        <div class="">
                        <select name="rightname" id="rightname" class="form-control @error('rightname') is-invalid @enderror" >
                            @foreach($rights as $right)
                            <option value="{{ $loop->index }}">{{ $right }}</option>
                            @endforeach
                        </select>
            
                            @error('rightname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="filename" class="col-md-4 col-form-label">Nom du fichier</label>

                        <div class="">
                        <select name="filename" id="filename" class="form-control @error('filename') is-invalid @enderror" >
                            @isset($files)
                            @foreach($files as $file)
                            <option value="{{ $file->id}}">{{ $file->filename}}</option>
                            @endforeach
                            @endisset
                        </select>
            
                            @error('filename')
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
        <div class="col-6 p-2">
            <div class="wrapper p-4 card">
                <h4>Assigner un droit à un dossier</h4>
                <form method="POST" action="/assign-right-folder">
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
                        <label for="rightname" class="col-md-4 col-form-label">Nom du droit</label>

                        <div class="">
                        <select name="rightname" id="rightname" class="form-control @error('rightname') is-invalid @enderror" >
                            @foreach($rights as $right)
                            <option value="{{ $loop->index }}">{{ $right }}</option>
                            @endforeach
                        </select>
            
                            @error('rightname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foldername" class="col-md-4 col-form-label">Nom du dossier</label>

                        <div class="">
                        <select name="foldername" id="foldername" class="form-control @error('foldername') is-invalid @enderror" >
                            @isset($folders)
                            @foreach($folders as $folder)
                            <option value="{{ $folder->id}}">{{ $folder->foldername}}</option>
                            @endforeach
                            @endisset
                        </select>
            
                            @error('foldername')
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