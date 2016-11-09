@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Clients</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
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
                                <li class="dropdown">

                                    <a href="#"
                                       class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       role="button"
                                       aria-expanded="false">
                                        <i class="fa fa-wrench"></i>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{route('clients.create')}}">Add client</a>
                                        </li>
                                    </ul>

                                </li>

                                <li>
                                    <a class="close-link"><i class="fa fa-close"></i></a>
                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            @if(!empty($clients) and $clients->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Phone</th>
                                        <th>Curator</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <th>{{$client->id}}</th>
                                            <th>{{$client->name}}</th>
                                            <th>{{$client->email}}</th>
                                            <th>{{$client->phone}}</th>
                                            <th>
                                                @if($client->supervise)
                                                    <a href="{{route('user.profile',['id' => $client->supervise->id])}}">{{$client->supervise->name}}</a>
                                                @else
                                                    none
                                                @endif
                                            </th>
                                            <th>{{date('d.m.Y H:i', strtotime($client->created_at))}}</th>
                                            <th>
                                                <div class="btn-group">
                                                    <a class="btn btn-small btn-primary btn-round" href="{{route('clients', ['id'=> $client->id])}}"> View</a>
                                                    <a class="btn btn-small btn-primary btn-round" href="{{route('clients.edit', ['id'=> $client->id])}}"> Edit</a>
                                                    <a class="btn btn-small btn-primary btn-round" onclick="event.preventDefault();document.getElementById('clients-{{$client->id}}-delete-form').submit();"> delete</a>
                                                </div>
                                                @include('forms.clients_delete_form', ['id' => $client->id])
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                @if($clients->total() > 1 )
                                    @if(request()->has('items') && is_numeric(request('items')))
                                        {{$clients->appends(['items' => request('items')])->links()}}
                                    @else
                                        {{$clients->links()}}
                                    @endif
                                @endif

                            @else
                                <div class="alert alert-info">
                                    <h4>Clients not found</h4>
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
