@extends('layouts/app')

@section('content')
<script>
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>


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
        <div class=" mt-3 modify-root-nav">

            @isset($folder_id)

            <h1>{{$folder_id}}</h1>

            @endisset

            <div class="row p-3">
                <div class="col-5 mr-auto">
                    <h4>Créer un dossier</h4>
                    <form class="row" method="POST" action="/create-folder">
                        @csrf
                        <input type='text' id='foldername' class="col-12" name='foldername' required maxlength='20' placeholder="Nom du nouveau dossier">
                        <select name="parent_folder" id="parent_folder" class="form-control my-3">
                            <option value="null">Root</option>

                            @foreach($folderlists as $folderlist)

                            <option value="{{$folderlist}}">{{ $folderlist->foldername }}</option>

                            @endforeach

                        </select>

                        <button class="custom-btn-secondary mr-auto col-5 p-1" type='submit'>Creer un dossier ici</button>
                    </form>

                </div>
                <div class="col-1 text-center">
                    <div class="hr-vertical mx-auto"></div>
                </div>
                <div class="col-5 ml-auto">
                    <h4>Uploader un fichier</h4>
                    <form action="{{ route('post.file') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <select name="parent_folder" id="parent_folder" class="form-control">
                            <option value="0">Root</option>
                            @foreach($folderlists as $folderlist)
                            <option value="{{ $folderlist-> id }}">{{ $folderlist->foldername }}</option>
                            @endforeach
                        </select>

                        <input type="file" name="file" class="form-control my-3">

                        <button type="submit" class="custom-btn-secondary mr-auto col-5 p-1">Upload</button>

                    </form>
                </div>
            </div>
        </div>
</section>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@elseif ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<section class="custom-card container mb-5 p-3">
    <div id="accordion" class="border rounded">

        @foreach($folderlists as $folderlist)
        @foreach($rights as $right)
        <!-- Liste des dossiers à la racines -->
        @if($right->folder_id == $folderlist->id && $right->type == 1 )
        <!-- 1 : Droits pour voir -->
        <div class="card mb-4">
            @if($folderlist->parent_folder==null)
            <div class="card-header p-0" id="headingOne">
                <div class="card-header p-0" id="headingOne">
                    <div class="row">
                        <button class="btn col-6" data-toggle="collapse" data-target="#collapse{{ $folderlist->id }}" aria-expanded="true" aria-controls="collapseOne">
                            <h4>{{ $folderlist->foldername }}</h4>
                        </button>
                        @include('ged/folder-right')
                    </div>
                </div>
                <div id="collapse{{ $folderlist->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

                    @isset($filelist)
                    @foreach($filelist as $file)
                    @foreach($rights as $right)
                    @if($right->file_id == $file->id && $right->type == 1 )
                    <!-- 1 : Droits pour voir -->
                    @if($file->folder_id==$folderlist->id)

                    @include('ged/file')

                    @endif
                    @endif
                    @endforeach
                    @endforeach
                    @endisset
                </div>
            </div>
            @endif
        </div>
        @endif
        @endforeach
        @endforeach
        @isset($filelist)
        @foreach($filelist as $file)
        <hr>
        @foreach($rights as $right)
        <!-- -->
        @if($right->file_id == $file->id && $right->type == 1 )
        <!-- -->
        @if($file->folder_id==null)

        @include('ged/file')
        @endif
        @endif
        @endforeach
        @endforeach
        @endisset

        <!-- <div class="popup"  >
            <button onclick="myFunction()" >Popup
                <span class="popuptext" id="myPopup" >Popup text...</span>
            </button>
        </div> -->
    </div>
    </div>
</section>





@endsection