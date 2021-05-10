@extends('layouts/app')

@section('content')

<style>
    nav{background-color: #7dc48f75!important;}
    footer{bottom: auto;}
</style>

<section class="home-top">
    <div class="container">
        <div class="col-6">
            <h1 class="primary-font">Bienvenue sur File Flip</h1>
            <p>Votre plateforme de Gestion Electronique de Documents. Inscrivez-vous afin de pouvoir dès maintenant profiter de vos documents où que vous soyez, sur votre ordinateur, votre smartphone ou votre tablette !</p>
            <a href="{{ route('register') }}" class="btn custom-btn-primary">S'inscrire</a>
        </div>
    </div>
</section>
<section class="home-middle regular-section container">
    <div class="row my-auto">
        <h2 class="mb-5">Une gestion conçue pour être performante et partagée</h2>
        <article class="col-5 mx-auto row">
            <img class="mx-auto col-4 mb-4" src="image/icon-1.png" alt="des dossiers" style="height: 7rem; position:relative; bottom:0,5rem;">
            <p style="position: relative; bottom: 1rem;">Grâce à une interface fluide et intuitive, la gestion de documents en ligne n'a jamais été aussi simple.</p>
        </article>
        <article class="col-5 mx-auto row">
            <img class="mx-auto col-4 mb-4" src="image/icon-2.png" alt="des dossiers">
            <p>Créez des groupes avec d'autres membres de la communauté FileFlip afin de partagez vos documents. Une interface de gestion des droits est intégrée à notre solution </p>
        </article>

    </div>
</section>
<!-- <a href="#" style="position: relative;left: 95rem;"><i class="bi bi-arrow-bar-up" style="font-size: 2rem;" ></i></a> -->
@endsection

