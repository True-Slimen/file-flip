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
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, doloremque dolores doloribus culpa id debitis sed veniam? Nam numquam, assumenda enim unde ex blanditiis ducimus, sit nostrum est soluta repudiandae.</p>
            <a href="/sign-up" class="btn custom-btn-primary">S'inscrire</a>
        </div>
    </div>
</section>
<section class="home-middle regular-section container">
    <div class="row my-auto">
        <h2 class="mb-5">Lorem ipsum dolor sit amet consectetur.</h2>
        <article class="col-5 mx-auto row">
            <img class="mx-auto col-3 mb-3" src="image/icon-1.png" alt="des dossiers">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero consectetur ut facilis harum commodi, mollitia eum.</p>
        </article>
        <article class="col-5 mx-auto row">
            <img class="mx-auto col-3 mb-3" src="image/icon-2.png" alt="des dossiers">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero consectetur ut facilis harum commodi, mollitia eum.</p>
        </article>

    </div>
</section>

@endsection
