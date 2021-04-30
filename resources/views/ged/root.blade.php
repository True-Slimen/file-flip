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
            <div class="card mb-4">
                @if($folderlist->parent_folder==null)
                <div class="card-header p-0" id="headingOne">
                    <div class="card-header p-0" id="headingOne">
                        <div class="row">
                            <button class="btn col-11" data-toggle="collapse" data-target="#collapse{{ $folderlist->id }}" aria-expanded="true" aria-controls="collapseOne">
                                <h4>{{ $folderlist->foldername }}</h4>
                            </button>
                            @isset($isAdmins)
                            @foreach($isAdmins as $isAdmin)
                             @if($isAdmin->type == 4 && $isAdmin->folder_id ==$folderlist->id )
                             <form class="col-1" method="POST" action="/delete-folder">
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
                    <ul>
                        @isset($filelist)
                        @foreach($filelist as $file)
                        @if($file->folder_id==$folderlist->id)
                        <li>
                            <div class="row">
                            <a class="col-11" href="{{url('/')}}/uploads/{{ $file->filename}}" target="_blank">{{ $file->filename }}</a>
                            @isset($isAdmins)
                            @foreach($isAdmins as $isAdmin)
                             @if($isAdmin->type == 4 && $isAdmin->file_id ==$file->id )
                             <form class="col-1" method="POST" action="/delete-file">
                                @csrf

                                <button name="file_id" value="{{ $file->id }}" class="btn btn-danger col-12" type='submit'>
                                    <h4>X</h4>
                            </form>
                             @endif
                            @endforeach
                            
                            @endisset
                            </div>
                        </li>
                        @endif
                        @endforeach
                        @endisset
                    <ul>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
            @isset($filelist)
            @foreach($filelist as $file)
            @if($file->folder_id==null)
            <ul>
                <a href="{{url('/')}}/uploads/{{ $file->filename}}" target="_blank">{{ $file->filename }}</a>
            </ul>
            @endif
            @endforeach
            @endisset
        </div>
    </div>
</section>


@endsection