<tr>
    <th>#{{$trade->id}}</th>
    <th>{{$trade->statuses->name or 'None'}}</th>
    <th>
        @if($trade->ppCode)
            <abbr title="{{$trade->ppCode->description}}"
                  class="initialism">{{ $trade->ppCode->code or trans('modules.empty') }}</abbr>
        @else
            ID# {{$trade->ppc}}
        @endif
    </th>
    <th>
        @if($trade->supervisor)
            <a href="{{route('user.profile',['id' => $trade->supervisor->id])}}"><i
                        class="fa fa-user"></i> {{ $trade->supervisor->name }}</a>
        @else
            ID# {{$trade->curador}}
        @endif
    </th>
    <th>
        @if($trade->client)
            <a href="{{route('clients',['id' => $trade->client->id])}}"><i
                        class="fa fa-user"></i> {{$trade->client->name}}</a>
        @else
            ID# {{$trade->client_id}}
        @endif
    </th>
    <th>
        @if($trade->payment_is_completed)
            {{ trans('trade::view.table.completed_by') }} @if($trade->completer)
                <a href="{{ route('user.profile',['id' => $trade->completer->id]) }}"><i
                            class="fa fa-user"></i> {{ $trade->completer->name }}</a>
            @else
                User ID: {{$trade->completed_by_user}}
            @endif
        @else
            {{ trans('trade::view.table.not_complete') }}
        @endif
    </th>
    <th>
        @if($trade->products->count())
            @foreach($trade->products as $product)
                <a href="{{route('products',['id' => $product->id])}}">{{$product->name}}</a>
            @endforeach
        @else
            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-product-modal" data-trade="{{$trade->id}}">{{ trans('modules.menu.context.add') }}</a>
        @endif
    </th>
    <th>{{date('d.m.Y H:i', strtotime($trade->created_at))}}</th>
    <th>
        <!-- Split button -->
        <div class="btn-group">
            <a class="btn btn-sm btn-primary" href="{{route('trade.show', ['id'=> $trade->id])}}"> {{ trans('trade::view.button.more') }}</a>
            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">{{ trans('modules.menu.dropdown') }}</span>
            </button>
            <ul class="dropdown-menu">
                <li><a data-toggle="modal" data-target="#add-product-modal" data-trade="{{$trade->id}}">{{ trans('trade::view.button.add_products') }}</a></li>
                <li><a href="{{route('trade.edit', ['id'=> $trade->id])}}"> {{ trans('trade::view.button.edit') }}</a></li>
                <li><a onclick="event.preventDefault();document.getElementById('trade-{{$trade->id}}-delete-form').submit();">{{ trans('trade::view.button.delete') }}</a></li>
            </ul>
        </div>
        @include('forms.delete_form', ['id' => $trade->id, 'slug' => 'trade'])
    </th>
</tr>