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