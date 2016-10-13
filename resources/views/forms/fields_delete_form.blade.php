<form id="fields-{{$id}}-param-delete-form" action="{{ route('fields.delete',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>