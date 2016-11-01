<form id="{{$slug}}-{{$id}}-delete-form" action="{{ route('user.' . $slug . '.delete',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>