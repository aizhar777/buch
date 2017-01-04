<form id="role-{{$id}}-delete-form" action="{{ route('user.roles.delete',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>