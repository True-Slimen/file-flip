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
        <h4>Groupe existant</h4>
                <div id="accordion">
                    @foreach($folders as $folder)
                        <div class="card mb-4">
                            <div class="card-header p-0" id="headingOne">
                                <button class="btn col-12" data-toggle="collapse" data-target="toto" aria-expanded="true" aria-controls="collapseOne">
                                <h4>{{ $folder -> foldername }}</h4>
                                </button>
                            </div>

                            <div id="tata" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            @foreach($files as $file)
                            <div class="card-body p-0">
                                <ul class="mt-2">
                                
                                    <li>{{ $file -> filename }}</li>
                                    
                                </ul>
                            </div>
                    @endforeach
²                      </div>
                    </div>
                    @endforeach
                </div>
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