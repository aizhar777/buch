@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stores
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Stores List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('stock.create')}}">Add stock</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

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
                @else
                    <div class="alert alert-info">
                        <h4>Products not found</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($stocks->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$stocks->appends(['items' => request('items')])->links()}}
                    @else
                        {{$stocks->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
