<form id="stock-{{$id}}-delete-form" action="{{ route('stock.destroy',['id' => $id]) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>