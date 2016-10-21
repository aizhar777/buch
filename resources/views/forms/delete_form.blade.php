<form id="{{$slug}}-{{$id}}-delete-form" action="{{ route($slug.'.destroy',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>