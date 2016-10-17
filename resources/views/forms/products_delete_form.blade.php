<form id="products-{{$id}}-delete-form" action="{{ route('products.delete',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>