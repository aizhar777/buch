<form id="settings-{{$id}}-delete-form" action="{{ route('settings.delete',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>