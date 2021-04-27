@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <h1>Bienvenue sur le Dashboard</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, doloremque dolores doloribus culpa id debitis sed veniam? Nam numquam, assumenda enim unde ex blanditiis ducimus, sit nostrum est soluta repudiandae.</p>
    <a href="/dashboard/createfixtures" class="btn btn-success">Créer des utilisateurs</a>
</section>
<section class="custom-card container regular-section">
    <div class="row">
        <div class="col-6 mt-4 mb-3">
            <div class="card wrapper p-3">
            <h4>Groupe</h4>
            Vous appartenez aux groupes:
            <ul>
                <li>Groupe A</li>
            </ul>
            <a href="/edit-group">Editer mes groupes</a>
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

    </div>
    <div class="text-center">
        <a class="mx-auto btn my-3 custom-btn-secondary" href="/ged/root">Explorer le GED</a>
    </div>
</section>

@endsection