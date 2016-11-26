
@if(!empty($products))
<table id="products_table" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>PID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th style="width: 90px;">Amount</th>
        <th>Stock</th>
        <th>Subdivision</th>
        <th>Sum</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total = 0.00;
    ?>
    @foreach($products as $product)
        <?php
        $sum = (double)$product->price * (double)$product->pivot->quantity;
        ?>
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{str_limit($product->description, 150)}}</td>
            <td>{{number_format($product->price, 2, '.', ' ')}}</td>
            <td>
                <div class="trade-produvct-amount">{{$product->pivot->quantity}}</div>
                <form action="{{route('trade.update.product.amount',['id' => $trade_id])}}" style="display: none">
                    <div class="input-group">
                        <input type="hidden" name="trade" value="{{$trade_id}}">
                        <input type="hidden" name="product" value="{{$product->id}}">
                        <input class="form-control" type="number" name="amount" min="1" value="{{$product->pivot->quantity}}" @if(!$product->is_service) max="{{$product->balance}}" @endif placeholder="Amount">
                        <span class="input-group-btn">
                            <button onclick="application.updateAmountProducts(this)" class="btn btn-default" type="button"><i class="ion ion-checkmark"></i></button>
                        </span>
                    </div>
                </form>
            </td>
            <td>{{$product->stock->name}}</td>
            <td>{{$product->subdivision->name}}</td>
            <td>{{number_format($sum, 2, '.', ' ')}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php
        $total += (double)$sum;
        ?>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>PID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Stock</th>
        <th>Subdivision</th>
        <th>Sum</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>
@else
    <div class="alert alert-info">Products no</div>
@endif