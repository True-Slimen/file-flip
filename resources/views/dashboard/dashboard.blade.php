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
            Vous appartenez aux groupes :
            <ul>
                <li>Groupe A</li>
            </ul>
            <div class="row justify-content-around">
                <a class="btn btn-outline-secondary col-4" href="/edit-group">Editer mes groupes</a>
                <a class="btn btn-outline-secondary col-4" href="/edit-admin-group">Editer les groupes</a>
            </div>
            </div>
        </div>
        <div class="col-6 mt-4 mb-3">
            <div class="card p-3 wrapper">
                <h4>Fichiers enregistrés</h4>
                Vous avez enregistré ces fichiers:
                <ul>
                    <li><a href="#">tuto.php</a></li>
                </ul>
                <a href="/upload-file">Enregistrer un fichier</a>
            </div>
        </div>
        <div class="col-6 mt-2 mb-3">
            <div class="card wrapper p-3">
            <h4>Rôles</h4>
            Vous possédez les rôles :
            <ul>
                <li>Rôle A</li>
            </ul>
            <div class="row justify-content-around">
                <a class="btn btn-outline-secondary col-4" href="/edit-right">Editer mes rôles</a>
                <a class="btn btn-outline-secondary col-4" href="/edit-right">Editer les rôles</a>
            </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a class="mx-auto btn my-3 custom-btn-secondary" href="/ged/root">Explorer le GED</a>
    </div>
</section>

@endsection