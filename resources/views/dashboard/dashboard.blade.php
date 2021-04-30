@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <h1>Bienvenue sur le Dashboard</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, doloremque dolores doloribus culpa id debitis sed veniam? Nam numquam, assumenda enim unde ex blanditiis ducimus, sit nostrum est soluta repudiandae.</p>
    <a href="/dashboard/createfixtures" class="btn btn-success">Créer des utilisateurs</a>
</section>
<section class="custom-card container regular-section">
    <div class="row">
        <div class="text-center mt-4">
            <a class="mx-auto btn mb-3 custom-btn-secondary" href="/ged/root">Explorer le GED</a>
        </div>
        <div class="col-6 mt-4 mb-3">
            <div class="card wrapper p-3">
                <h4>Groupe</h4>
                @isset($members)
                Vous appartenez aux groupes :
                <ul>
                    @foreach($members as $member)
                    <li>{{ $member->group->name }}</li>
                    @endforeach
                </ul>
                @endisset
                <div class="row justify-content-around">
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/edit-group">Editer les groupes</a>
                </div>
            </div>
        </div>
        <div class="col-6 mt-4 mb-3">
            <div class="card p-3 wrapper">
                <h4>Fichiers enregistrés</h4>
                Vous avez enregistré ces fichiers:
                @foreach($files as $file)
                <ul>
                    <li><a>{{ $file -> filename }} </a></li>
                </ul>
                @endforeach
                <a href="/upload-file">Enregistrer un fichier</a>
            </div>
        </div>
        <div class="col-6 mt-2 mb-3">
            <div class="card wrapper p-3">
                <h4>Rôles</h4>
                @isset($roles)
                Vous possédez les rôles :
                <ul>
                    @foreach($roles as $role)
                    @if($role->type == 10)
                    <li>Admin</li>
                    @elseif($role->type == 11)
                    <li>Membre</li>
                    @endif
                    @endforeach
                </ul>
                @endisset
                <div class="row justify-content-around">
                    @foreach($isadmin as $right)
                    @if($right->type==10)
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/edit-role">Editer les rôles</a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-6 mt-2 mb-3">
            <div class="card wrapper p-3">
                <h4>Droits</h4>
                <div class="row justify-content-around">
                    @foreach($isadmin as $right)
                    @if($right->type==10)
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/edit-right">Editer les droits</a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a class="mx-auto btn my-3 custom-btn-secondary" href="/ged/root">Explorer le GED</a>
    </div>
</section>

@endsection