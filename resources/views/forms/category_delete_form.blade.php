<form id="category-{{$id}}-delete-form" action="{{ route('category.delete',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>