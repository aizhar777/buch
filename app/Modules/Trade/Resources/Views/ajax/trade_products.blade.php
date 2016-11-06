<div class="x_panel">
    <div class="x_title">
        <h2>Products</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        @if(!empty($products))
            {!! $products !!}
        @else
            <div class="alert alert-info">Products no</div>
        @endif
    </div>
</div>
