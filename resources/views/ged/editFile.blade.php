@extends('layouts/app')

@section('content')

<form class="col-4 p-0" method="POST" action="/ged/edit/{{$file_id}}">
@csrf
    <textarea name="content" style='position: relative; margin-left: 6rem; height: 37rem; width: 73rem; top: 4rem;'>
        <?php echo $content ?>
    </textarea>
    <button style="position: relative; bottom: 33rem; height: 2rem; width: 5rem; left: 0.5rem;" type="submit" class="btn btn-outline-secondary btn-sm col-12" data-toggle="modal">Saugegarder</button>  
</form>
@endsection