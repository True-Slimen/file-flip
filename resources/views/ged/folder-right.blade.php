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
            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalMove">
                Déplacer
            </button>
            <div class="modal fade" id="modalMove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            @csrf
            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalRename">
                Renommer
            </button>
            <div class="modal fade" id="modalRename" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Renommer ce fichier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nouveau nom</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary " type="submit">Renommer</button>
                        </div>
                    </div>
                </div>
            </div>
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