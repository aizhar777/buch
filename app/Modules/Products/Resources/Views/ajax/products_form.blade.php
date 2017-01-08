<div class="form-group">
    <label for="select_products">Select products</label>
    <select name="products[]" id="select_products" class="select2_multiple form-control" multiple="multiple">
        @foreach($products as $product)
            <option value="{{$product->id}}" data-balance="{{$product->balance}}" data-service="{{($product->is_service)? "1": "0"}}">{{$product->name}} price: {{number_format($product->price)}} {{(!$product->is_service)? '('.$product->balance.')' : ''}}</option>
        @endforeach
    </select>
    <span id="helpBlock" class="help-block">Please select the products, and then change the number</span>
</div>
<div id="options_block" style="margin: 0;padding: 0;"></div>