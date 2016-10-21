<form id="subdivision-{{$id}}-delete-form" action="{{ route('subdivision.destroy',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>