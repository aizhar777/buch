<form id="clients-{{$id}}-delete-form" action="{{ route('clients.delete',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>