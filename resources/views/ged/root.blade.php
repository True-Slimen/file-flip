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
        <strong>Dossiers</strong>
        <div class=" mt-3 card modify-root-nav mb-5">
            @isset($foldertest)
            <h1>{{$foldertest[0]}}</h1>
            @endisset
            <div class="row p-3">
                <div class="col-6 text-center">
                    <form method="POST" action="/create-folder">
                        @csrf
                        <input type='text' id='foldername' name='foldername' required maxlength='20'>
                        <select name="parent_folder" id="parent_folder" class="form-control" >
                            <option value="null">Root</option>
                            @foreach($folderlists as $folderlist)
                            <option value="{{ $folderlist->id }}">{{ $folderlist }}</option>
                            @endforeach
                        </select>
                        <input type='hidden' id='folderdeep' value='{{$folderlist->deep}}' name='folderdeep' required maxlength='20'>
                        
                        <button class="custom-btn-secondary" type='submit'>Creer un dossier ici</button>
                    </form>
                </div>
                <div class="col-6 text-center">
                    <a class="custom-btn-secondary" href="/upload-file">Uploader un fichier ici</a>
                </div>
            </div>
        </div>
        <!-- @isset($folderlists)
        @foreach($folderlists as $folderlist)
        <p>{{ $folderlist->foldername}}</p>
        @endforeach
        @endisset -->
        <div id="accordion">
            @foreach($folderlists as $folderlist)
            <div class="card mb-4">
                @if($folderlist->parent_folder==null)
                <div class="card-header p-0" id="headingOne">
                    <button class="btn col-12" data-toggle="collapse" data-target="#collapse{{ $folderlist->id }}" aria-expanded="true" aria-controls="collapseOne">
                        <h4>{{ $folderlist->foldername }}</h4>
                    </button>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection