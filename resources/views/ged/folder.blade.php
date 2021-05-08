@extends('layouts/app')

@section('content')

<section class="container section-top mb-5">
    <div class="row">
        <div class="text-right">
            <a class="btn my-3 custom-btn-secondary" href="/dashboard">Dashboard</a>
        </div>
        @if($targetFolder->parent_folder==0)
        <p><a href='/ged/root'>Racine</a>>{{$targetFolder->foldername}}</p>
        @else
        <p><a href='/ged/root'>Racine</a>...>{{$targetFolder->foldername}}</p>
        @endif
    </div>
</section>

<section class="custom-card container mb-5 p-3">
    <ul>
        {{$targetFolder->foldername}}
        @foreach($folderList as $folderlist)
            @foreach($rights as $right)
                <!-- Liste des dossiers à la racines -->
                @if($right->folder_id == $folderlist->id && $right->type == 1 )
                    <!-- 1 : Droits pour voir -->
                    <div class="card mb-4">
                        <div class="card-header p-0" id="headingOne">
                            <div class="card-header p-0" id="headingOne">
                                <div class="row">
                                    <a class="button btn col-6" aria-controls="collapseOne" href='/ged/folder/{{$folderlist->id}}'>
                                        <h4>{{ $folderlist->foldername }}</h4>
                                    </a>
                                    @include('ged/folder-right')
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach

        @isset($fileList)
            @foreach($fileList as $file)
            <hr>
                @foreach($rights as $right)
                <!-- -->
                    @if($right->file_id == $file->id && $right->type == 1 )
                    <!-- -->
                            @include('ged/file')
                    @endif
                @endforeach
            @endforeach
        @endisset
    </ul>
</section>

@endsection