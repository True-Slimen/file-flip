<!--- Popup pour les fichiers--->
<form class="col-4 p-0" method="POST" action="/copy-file">
@csrf
<div class="modal fade" id="modalCopyFile_{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Copier ce fichier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Dossier cible</label>
                    <select name="parent_folder" id="parent_folder" class="form-control">
                        <option value="null">Root</option>

                        @foreach($folderlists as $folderlist)

                        <option value="{{$folderlist -> id}}">{{ $folderlist->foldername }}</option>

                        @endforeach

                    </select>
                    <input hidden type="text" class="form-control" id="file_id" value="{{$file->id}}" name="file_id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Copier</button>
            </div>
        </div>
    </div>
</div>
</form>
<form class="col-4 p-0" method="POST" action="/move-file">
@csrf
<div class="modal fade" id="modalMoveFile_{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Déplacer ce fichier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Dossier cible</label>
                    <select name="parent_folder" id="parent_folder" class="form-control">
                        <option value="null">Root</option>

                        @foreach($folderlists as $folderlist)

                        <option value="{{$folderlist -> id}}">{{ $folderlist->foldername }}</option>

                        @endforeach

                    </select>
                </div>
                <input hidden value="{{$file->id}}" name='file_id'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Déplacer</button>
            </div>
        </div>
    </div>
</div>
</form>

<form class="col-4 p-0" method="POST" action="/rename-file">
@csrf
<div class="modal fade" id="modalRenameFile_{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Renommer ce dossier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="new_name" class="col-form-label">Nouveau nom</label>
                    <input type="text" class="form-control" id="new_name" name="new_name">
                    <input hidden type="text" class="form-control" id="file_id" value="{{$file->id}}" name="file_id">
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

