@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <h1>Bienvenue sur le Dashboard</h1>
    <p>Explorez vos fichiers, ajoutez-en à votre espace, creez et gérer vos groupes. Manager les droits relatifs à vos fichiers afin d'avoir un contrôle total sur leur visibilité.</p>
</section>
<section class="custom-card container regular-section">
    <div class="row">
        <div class="text-center mt-4">
            <a class="mx-auto btn mb-3 custom-btn-secondary" href="/ged/root">Explorer le GED</a>
        </div>
        <div class="col-6 mt-4 mb-3">
            <div class="card wrapper p-3">
                <h4><strong>Groupe</strong></h4>
                @isset($ownGroups)
                @if(count($ownGroups) > 0)
                <p>Vous appartenez aux groupes :</p>
                @else
                <p>Vous n'appartenez à aucun groupe</p>
                @endif
                <ul>
                    @foreach($ownGroups as $ownGroup)
                    <li>{{ $ownGroup->group->name }}</li>
                    @endforeach
                </ul>
                @endisset
                <hr>
                <div class="row justify-content-around">
                @foreach($isadmin as $right)
                    @if($right->type==10)
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/edit-group">Editer les groupes</a>
                    @endif
                @endforeach
                </div>
            </div>
            <div class="card wrapper mt-3 p-3">
                <h4><strong>Rôles</strong></h4>
                @isset($roles)
                Vous possédez le rôle :
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
                <hr>
                <div class="row justify-content-around">
                    @foreach($isadmin as $right)
                    @if($right->type==10)
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/edit-role">Editer les rôles</a>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="card wrapper mt-3 p-3">
                <h4><strong>Créer un utilisateur</strong></h4>
                @isset($members)
                    <p class="mt-2">Liste des utilisateurs :</p>
                    @foreach($members as $member)
                    <ul>
                        <li>{{ $member->firstname }} - <i>{{ $member->email }}</i></li>
                    </ul>
                    @endforeach
                    <hr>
                @endisset
                <div class="row justify-content-around">
                    @foreach($isadmin as $right)
                    @if($right->type==10)
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/create-user">Créer un utilisateur</a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-6 mt-4 mb-3">
            <div class="card p-3 wrapper">
                <h4><strong>Fichiers enregistrés</strong></h4>
                Vous avez enregistré ces fichiers:
                @foreach($files as $file)
                <ul>
                    <li><a>{{ $file -> filename }} </a></li>
                </ul>
                @endforeach
                <hr>
                <div class="row justify-content-around">
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/upload-file">Enregistrer un fichier</a>
                </div>
            </div>
            <div class="card wrapper mt-3 p-3">
                <h4><strong>Droits</strong></h4>
                <hr>
                <div class="row justify-content-around">
                    @foreach($isadmin as $right)
                    @if($right->type==10)
                    <a class="btn btn-outline-secondary mr-auto ml-3 col-4" href="/edit-right">Editer les droits</a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-6 mt-2 mb-3">
            
        </div>
        <div class="col-6 mt-2 mb-3">
            
        </div>
    </div>
    <div class="text-center">
        <a class="mx-auto btn my-3 custom-btn-secondary" href="/ged/root">Explorer le GED</a>
    </div>
</section>

@endsection