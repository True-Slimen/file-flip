
                            

                            <ul>
                                <li class="row file-list">
                                    <a class="col-6" href="{{url('/')}}/{{$file->shortpath}}/{{ $file->filename}}" target="_blank">{{ $file->filename }}</a>
                                @isset($rights)
                                    <div class="col-3 ml-auto edit-file-wrapper row">
                                    @foreach($rights as $right)
                                        @if( $right->file_id == $file->id && $right->type == 6 )
                                            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalCopyFile_{{$file->id}}">
                                                Copier
                                            </button>  
                                        @elseif($right->file_id == $file->id && $right->type == 3 )
                                            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalMoveFile_{{$file->id}}">
                                                Déplacer
                                            </button>
                                        @elseif($right->file_id == $file->id && $right->type == 5 )
                                            <button type="button" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal" data-target="#modalRenameFile_{{$file->id}}">
                                                Renommer
                                            </button>
                                        @elseif($right->file_id == $file->id && $right->type == 3 )
                                            <a class="btn btn-outline-secondary btn-sm col-12" onclick="window.open('/ged/edit-file/{{$file->id}}')" data-toggle="modal" href="/ged/edit-file/{{$file->id}}"> 
                                            Edit 
                                            </a>
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

                            @include('ged/popupfile')
                            