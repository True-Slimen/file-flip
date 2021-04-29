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
            <div class="row p-3">
                <div class="col-6 text-center">
                    <form method="POST" action="/create-folder">
                        @csrf
                        <input type='text' id='foldername' name='foldername' required maxlength='20'>
                        <button class="custom-btn-secondary">Creer un dossier ici</button>
                    </form>
                </div>
                <div class="col-6 text-center">
                    <button class="custom-btn-secondary">Uploader un fichier ici</button>
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
                <div class="card-header p-0" id="headingOne">
                    <button class="btn col-12" data-toggle="collapse" data-target="#collapse{{ $folderlist->id }}" aria-expanded="true" aria-controls="collapseOne">
                        <h4>{{ $folderlist->foldername }}</h4>
                    </button>
                </div>

                <div id="collapse{{ $folderlist->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    @foreach($files as $file)
                    @if($file->folder_id == $folderlist->id)
                    <div class="card-body p-0">
                        <ul class="mt-2">

                            <li>{{ $file->filename }}</li>

                        </ul>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection