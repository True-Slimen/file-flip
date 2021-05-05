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
        <strong>Dossiers</strong>
        <div class=" mt-3 card modify-root-nav mb-5">

            @isset($folder_id)

            <h1>{{$folder_id}}</h1>

            @endisset

            <div class="row p-3">
                <div class="col-6 text-center">

                    <form method="POST" action="/create-folder">
                        @csrf
                        <input type='text' id='foldername' name='foldername' required maxlength='20'>
                        <select name="parent_folder" id="parent_folder" class="form-control">
                            <option value="null">Root</option>

                            @foreach($folderlists as $folderlist)

                            <option value="{{$folderlist}}">{{ $folderlist->foldername }}</option>

                            @endforeach
                            
                        </select>

                        <button class="custom-btn-secondary" type='submit'>Creer un dossier ici</button>
                    </form>

                </div>
                <div class="col-6 text-center">
                    <a class="custom-btn-secondary" href="/upload-file">Uploader un fichier ici</a>
                </div>
            </div>
        </div>

        <div id="accordion">

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
                                    <button class="btn col-11" data-toggle="collapse" data-target="#collapse{{ $folderlist->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        <h4>{{ $folderlist->foldername }}</h4>
                                    </button>
                                @isset($rights)
                                    @foreach($rights as $right)
                                        @if( $right->folder_id == $folderlist->id && $right->type == 4 )
                                        <form class="col-1" method="POST" action="/delete-folder">
                                            <!--Supprimer dossiers-->
                                            @csrf

                                            <button name="folder_id" value="{{ $folderlist->id }}" class="btn btn-danger col-12" type='submit'>
                                                <h4>X</h4>
                                        </form>
                                        @endif
                                    @endforeach

                                @endisset
                                </div>
                            </div>
                            <div id="collapse{{ $folderlist->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

                            @isset($filelist)
                                @foreach($filelist as $file)
                                    @foreach($rights as $right)
                                        @if($right->file_id == $file->id && $right->type == 1 )
                                        <!-- 1 : Droits pour voir -->
                                            @if($file->folder_id==$folderlist->id)

                                                <ul>
                                                    <li>
                                                        <div class="row">
                                                            <a class="col-11" href="{{url('/')}}/uploads/{{$folderlist->foldername}}/{{ $file->filename}}" target="_blank">{{ $file->filename }}</a>

                                                        @isset($rights)
                                                            @foreach($rights as $right)
                                                                @if( $right->file_id == $file->id && $right->file_id == $file->id)
                                                                    @if( $right->type == 4 )

                                                                        <form class="col-1" method="POST" action="/delete-file">
                                                                            @csrf
                                                                            <button name="file_id" value="{{ $file->id }}" class="btn btn-danger col-12" type='submit'>
                                                                                <h4>X</h4>
                                                                        </form>

                                                                    @elseif( $right->file_id == $file->id && $right->type == 6 )
                                                                    <!-- 6 : Droits pour copier -->

                                                                        <form class="col-1" method="POST" action="/copy-file">
                                                                            @csrf
                                                                            <button name="file_id" value="{{ $file->id }}" class="btn btn-warning col-12" type='submit'>
                                                                                <h4>X</h4>
                                                                        </form>
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                        @endisset
                                                        </div>
                                                    </li>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            @endisset
                                    <ul>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                @endforeach
            @endforeach

            @isset($filelist)
                @foreach($filelist as $file)
                    @foreach($rights as $right)
                    <!-- -->
                        @if($right->file_id == $file->id && $right->type == 1 )
                        <!-- -->
                            @if($file->folder_id==null)

                            <ul>
                                <li>
                                    <a href="{{url('/')}}/uploads/{{ $file->filename}}" target="_blank">{{ $file->filename }}</a>
                                @isset($rights)
                                    @foreach($rights as $right)

                                        @if( $right->file_id == $file->id && $right->type == 4 )
                                        <form class="col-1" method="POST" action="/delete-file">
                                            @csrf
                                            <button name="file_id" value="{{ $file->id }}" class="btn btn-danger col-12" type='submit'>
                                                <h4>X</h4>
                                        </form>

                                        @elseif( $right->file_id == $file->id && $right->type == 6 )

                                        <form class="col-1" method="POST" action="">
                                            @csrf
                                            <button name="file_id" value="{{ $file->id }}" class="btn btn-warning col-12" onclick="myFunction()">
                                                <h4>X</h4>
                                                <div class="popup"  >
                                                    <span class="popuptext" id="myPopup" hidden>Popup text...</span>
                                                </div>
                                        </form>

                                        @endif
                                    @endforeach
                                    <button name="file_id" value="{{ $file->id }}" class="btn btn-warning col-12" onclick="myFunction()">
                                            <h4>X</h4>
                                            <div class="popup">
                                                <span class="popuptext" id="myPopup" >Popup text...</span>
                                            </div>
                                @endisset
                                    </div>
                                </li>
                            </ul>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            @endisset
        
        <div class="popup"  >
            <button onclick="myFunction()" >Popup
                <span class="popuptext" id="myPopup" >Popup text...</span>
            </button>
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


@endsection