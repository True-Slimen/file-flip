
<!--- Popup pour les folders --->
<form class="col-4 p-0" method="POST" action="/copy-file">
@csrf
    <div class="modal fade" id="modalCopy_{{$folderlist -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <label for="recipient-name" class="col-form-label">Dossier cible</label>
                            <select name="parent_folder" id="parent_folder" class="form-control">
                                <option value="null">Root</option>

                                @foreach($folderlists as $folderlist)

                                <option value="{{$folderlist -> id}}">{{ $folderlist->foldername }}</option>

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
<form class="col-4 p-0" method="POST" action="/move-folder">
@csrf
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

                                @foreach($folderlists as $folderlist)

                                <option value="{{$folderlist -> id}}">{{ $folderlist->foldername }}</option>

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
<form class="col-4 p-0" method="POST" action="/rename-folder">
@csrf
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
                    <button class="btn btn-primary " type="submit">Renommer</button>
                </div>
            </div>
        </div>
    </div>
</form>