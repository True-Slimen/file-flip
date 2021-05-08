@isset($rights)

<div class="col-4 ml-auto edit-file-wrapper row">
    <div class="col-11 ml-auto edit-file-wrapper row">
        @foreach($rights as $right)
        @if( $right->folder_id == $folderlist->id && $right->type == 6)
        <form class="col-4 p-0" method="POST" action="/copy-file">
            @csrf
            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalCopy">
                Copier
            </button>
            <div class="modal fade" id="modalCopy" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Copier ce fichier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">
                                        Dossier cible
                                    </label>
                                    <select name="parent_folder" id="parent_folder" class="form-control">
                                        <option value="null">Root</option>

                                        @foreach($folderlists as $folder)

                                        <option value="{{$folder -> id}}">{{ $folder->folder }}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" type="submit">Copier</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @elseif($right->folder_id == $folderlist->id && $right->type == 3 )
        <form class="col-4 p-0" method="POST" action="/move-folder">
            @csrf
            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalMove_{{$folderlist->id}}">
                Déplacer
            </button>
            <div class="modal fade" id="modalMove_{{$folderlist->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Déplacer ce fichier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Dossier cible</label>
                                    <select name="parent_folder" id="parent_folder" class="form-control">
                                        <option value="null">Root</option>

                                        @foreach($folderlists as $folderright)

                                        <option value="{{$folderright -> id}}">{{ $folderright->foldername }}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" type="submit">Déplacer</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @elseif($right->folder_id == $folderlist->id && $right->type == 5 )
        <div class="col-4 p-0">
            <form class="col-4 p-0" method="POST" action="/rename-folder">
            @csrf
            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalRename_{{$folderlist->id}}">
                Renommer
            </button>
            <div class="modal fade" id="modalRename_{{$folderlist->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Renommer ce fichier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nouveau nom</label>
                                    <input name='new_name' type="text" class="form-control" id="recipient-name">
                                    <input hidden name='folder_id' type="text" class="form-control" id="recipient-name" value="{{$folderlist->id}}">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary " type="submit">Renommer</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endisset
@isset($rights)
<div class="col-1 mr-auto edit-file-wrapper row">
    @foreach($rights as $right)
    @if( $right->folder_id == $folderlist->id && $right->type == 4 )
    <form class="col-12 p-0" method="POST" action="/delete-folder">
        @csrf
        <button name="folder_id" value="{{ $folderlist->id }}" class="btn btn-outline-danger btn-sm col-12" type='submit'>
            X
        </button>
    </form>
    @endif
    @endforeach
</div>
@endisset