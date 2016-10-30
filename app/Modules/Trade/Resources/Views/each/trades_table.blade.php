<tr>
    <th>#{{$trade->id}}</th>
    <th>{{$trade->statuses->name or 'None'}}</th>
    <th>
        @if($trade->ppCode)
            <abbr title="{{$trade->ppCode->description}}"
                  class="initialism">Code: {{$trade->ppCode->code or 'None'}}</abbr>
        @else
            ID# {{$trade->ppc}}
        @endif
    </th>
    <th>
        @if($trade->supervisor)
            <a href="{{route('user.profile',['id' => $trade->supervisor->id])}}"><i
                        class="fa fa-user"></i> {{$trade->supervisor->name}}</a>
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
            Completed by @if($trade->completer)
                <a href="{{route('user.profile',['id' => $trade->completer->id])}}"><i
                            class="fa fa-user"></i> {{$trade->completer->name}}</a>
            @else
                User ID: {{$trade->completed_by_user}}
            @endif
        @else
            Is not complete
        @endif
    </th>
    <th>
        @if($trade->products->count())
            @foreach($trade->products as $product)
                <a href="{{route('products',['id' => $product->id])}}">{{$product->name}}</a>
            @endforeach
        @else
            NONE?
        @endif
    </th>
    <th>{{date('d.m.Y H:i', strtotime($trade->created_at))}}</th>
    <th>
        <div class="btn-group">
            <a class="btn btn-small btn-primary" href="{{route('trade.show', ['id'=> $trade->id])}}"> View</a>
            <a class="btn btn-small btn-primary" href="{{route('trade.edit', ['id'=> $trade->id])}}"> Edit</a>
            <a class="btn btn-small btn-primary"
               onclick="event.preventDefault();document.getElementById('trade-{{$trade->id}}-delete-form').submit();">
                delete</a>
        </div>
        @include('forms.delete_form', ['id' => $trade->id, 'slug' => 'trade'])
    </th>
</tr>