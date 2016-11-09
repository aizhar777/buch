@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Stock list</h3>
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
                                            <a href="{{route('stock.create')}}">Add stock</a>
                                        </li>
                                    </ul>

                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            @if(!empty($stocks) and $stocks->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Description</th>
                                        <th>Subdivision</th>
                                        <th>Responsible</th>
                                        <th>address</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stocks as $stock)
                                        <tr>
                                            <th>{{$stock->id}}</th>
                                            <th>{{$stock->name}}</th>
                                            <th>{{$stock->slug}}</th>
                                            <th>{{$stock->description or 'Empty'}}</th>
                                            <th>{{$stock->subdivision->name or $stock->subdivision_id}}</th>
                                            <th>
                                                @if(!is_null($stock->responsible))
                                                    {{$stock->user->name}}
                                                @else
                                                    None
                                                @endif
                                            </th>
                                            <th>{{$stock->address or 'Empty'}}</th>
                                            <th>{{date('d.m.Y H:i', strtotime($stock->created_at))}}</th>
                                            <th>
                                                <div class="btn-group">
                                                    <a class="btn btn-small btn-primary" href="{{route('stock.show', ['id'=> $stock->id])}}"> View</a>
                                                    <a class="btn btn-small btn-primary" href="{{route('stock.edit', ['id'=> $stock->id])}}"> Edit</a>
                                                    <a class="btn btn-small btn-primary" onclick="event.preventDefault();document.getElementById('stock-{{$stock->id}}-delete-form').submit();"> delete</a>
                                                </div>
                                                @include('forms.stock_delete_form', ['id' => $stock->id])
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                @if($stocks->total() > 1 )
                                    @if(request()->has('items') && is_numeric(request('items')))
                                        {{$stocks->appends(['items' => request('items')])->links()}}
                                    @else
                                        {{$stocks->links()}}
                                    @endif
                                @endif
                            @else
                                <div class="alert alert-info">
                                    <h4>Products not found</h4>
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
