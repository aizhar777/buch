@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Trade list</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form action="" method="get">
                            <div class="input-group">
                                <input name="query" type="text" class="form-control" placeholder="Search in stock...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                @include('block.flash_messages')

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>List</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li>
                                    <a title="Create new trade" href="{{route('trade.create')}}">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            @if(!empty($trades) and $trades->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Trade ID</th>
                                        <th>Status</th>
                                        <th>PPC</th>
                                        <th>Curator</th>
                                        <th>Client</th>
                                        <th>Payment is completed</th>
                                        <th>Products</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trades as $trade)
                                        <tr>
                                            <th>#{{$trade->id}}</th>
                                            <th>{{$trade->statuses->name or 'None'}}</th>
                                            <th>
                                                @if($trade->ppCode)
                                                    <abbr title="{{$trade->ppCode->description}}" class="initialism">Code: {{$trade->ppCode->code or 'None'}}</abbr>
                                                @else
                                                    ID# {{$trade->ppc}}
                                                @endif
                                            </th>
                                            <th>
                                                @if($trade->supervisor)
                                                    <a href="{{route('user.profile',['id' => $trade->supervisor->id])}}"><i class="fa fa-user"></i> {{$trade->supervisor->name}}</a>
                                                @else
                                                    ID# {{$trade->curador}}
                                                @endif
                                            </th>
                                            <th>
                                                @if($trade->client)
                                                    <a href="{{route('clients',['id' => $trade->client->id])}}"><i class="fa fa-user"></i> {{$trade->client->name}}</a>
                                                @else
                                                    ID# {{$trade->client_id}}
                                                @endif
                                            </th>
                                            <th>
                                                @if($trade->payment_is_completed)
                                                    Completed by @if($trade->completer)
                                                        <a href="{{route('user.profile',['id' => $trade->completer->id])}}"><i class="fa fa-user"></i> {{$trade->completer->name}}</a>
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
                                                    <a class="btn btn-small btn-primary" onclick="event.preventDefault();document.getElementById('trade-{{$trade->id}}-delete-form').submit();"> delete</a>
                                                </div>
                                                @include('forms.delete_form', ['id' => $trade->id, 'slug' => 'trade'])
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info">
                                    <h4>Trade not found</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
