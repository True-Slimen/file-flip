@extends('layouts/app')

@section('content')
<style>
    footer{bottom: 0;}
</style>

<section class="container section-top">
    <h4><strong>Contenu du fichier</strong></h4>
    <form class="col-12 p-0" method="POST" action="/ged/edit/{{$file_id}}">
    @csrf
        <textarea class="col-12 rounded" rows="10" name="content" >
            {{ $content }}
        </textarea>
        <button type="submit" class="custom-btn-secondary mt-3" data-toggle="modal">Sauvegarder</button>  
    </form>
</section>
@endsection