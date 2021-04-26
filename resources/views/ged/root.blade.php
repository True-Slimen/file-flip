@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <div class="row">
        <div class="text-right">
            <a class="btn my-3 custom-btn-secondary" href="/dashboard">Dashboard</a>
        </div>
        <p>Root ></p>
    </div>
</section>
<section class="custom-card container mb-5 p-3">
    <div class="row">
        <strong>Dossier</strong>
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