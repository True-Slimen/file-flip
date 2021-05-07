
                            <ul>
                                <li class="row file-list">
                                    <a class="col-6" href="{{url('/')}}/uploads/{{ $file->filename}}" target="_blank">{{ $file->filename }}</a>
                                @isset($rights)
                                    <div class="col-3 ml-auto edit-file-wrapper row">
                                        @foreach($rights as $right)
                                        @if( $right->file_id == $file->id && $right->type == 6 )
                                            <form class="col-4 p-0" method="POST" action="/copy-file">
                                                @csrf
                                                <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalCopyFile_{{$file->id}}">
                                                    Copier
                                                </button>
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
                                                                <button  class="btn btn-primary" type="submit">Copier</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @elseif($right->file_id == $file->id && $right->type == 3 )
                                            <form class="col-4 p-0" method="POST" action="/move-file">
                                                @csrf
                                                <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalMoveFile_{{$file->id}}">
                                                    Déplacer
                                                </button>
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
                                                                <form>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Dossier cible</label>
                                                                    <select name="parent_folder" id="parent_folder" class="form-control">
                                                                        <option value="null">Root</option>

                                                                        @foreach($folderlists as $folderlist)

                                                                        <option value="{{$folderlist -> id}}, {{$file -> id}}">{{ $folderlist->foldername }}</option>

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
                                        @elseif($right->file_id == $file->id && $right->type == 5 )
                                            <form class="col-4 p-0" method="POST" action="/rename-file">
                                                @csrf
                                                <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalRenameFile_{{$file->id}}">
                                                    Renommer
                                                </button>
                                                <div class="modal fade" id="modalRenameFile_{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        @endif
                                    @endforeach
                                        </div>
                                @endisset
                                @isset($rights)
                                        <div class="col-1 mr-auto edit-file-wrapper row">
                                        @foreach($rights as $right)
                                        @if( $right->file_id == $file->id && $right->type == 4 )
                                            <form class="col-12 p-0" method="POST" action="/delete-file">
                                                @csrf
                                                <button name="file_id" value="{{ $file->id }}" class="btn btn-outline-danger btn-sm col-12" type='submit'>
                                                    X
                                                </button>
                                            </form>
                                        @endif
                                        @endforeach
                                        </div>
                                    @endisset
                                    
                                </li>
                            </ul>
                            