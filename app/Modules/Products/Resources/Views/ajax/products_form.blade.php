<div class="form-group">
    <label for="select_products">{{ trans('products::module.ajax.select_products') }}</label>
    <select name="products[]" id="select_products" class="select2_multiple form-control" multiple="multiple">
        @foreach($products as $product)
            <option
                    value="{{$product->id}}"
                    data-balance="{{$product->balance}}"
                    data-service="{{($product->is_service)? "1": "0"}}"
            >
                {{$product->name}} {{ trans('products::module.ajax.price') }}: {{number_format($product->price)}} {{(!$product->is_service)? '('.$product->balance.')' : ''}}
            </option>
        @endforeach
    </select>
    <span id="helpBlock" class="help-block">{{ trans('products::module.ajax.help_block_notice') }}</span>
</div>
<h4>{{ trans('products::module.ajax.products_title') }}:</h4>
<div id="options_block" style="margin: 0;padding: 0;"></div>