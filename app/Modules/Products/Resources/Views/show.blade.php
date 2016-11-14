@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Products
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('block.flash_messages')

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('products.create')}}">Add product</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($products) and $products->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Cost</th>
                            <th>Balance</th>
                            <th>Stock</th>
                            <th>Subdivision</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>{{$product->id}}</th>
                                <th style="width: 10%">{{$product->name}}</th>
                                <th style="width: 40%">{{str_limit($product->description, 180)}}</th>
                                <th>{{number_format($product->price,2,'.','&nbsp;')}}</th>
                                <th>{{number_format($product->cost,2,'.','&nbsp;')}}</th>
                                <th>
                                    @if($product->is_service)
                                        <span class="label label-default">Service</span>
                                    @else
                                        {{$product->balance}}
                                    @endif
                                </th>
                                <th>{{$product->stock->name or $product->stock_id}}</th>
                                <th>{{$product->subdivision->name or $product->subdivision_id}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($product->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-small btn-primary btn-round" href="{{route('products', ['id'=> $product->id])}}"> View</a>
                                        <a class="btn btn-small btn-primary btn-round" href="{{route('products.edit', ['id'=> $product->id])}}"> Edit</a>
                                        <a class="btn btn-small btn-primary btn-round" onclick="event.preventDefault();document.getElementById('products-{{$product->id}}-delete-form').submit();"> delete</a>
                                    </div>
                                    @include('forms.products_delete_form', ['id' => $product->id])
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

                @if($products->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$products->appends(['items' => request('items')])->links()}}
                    @else
                        {{$products->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
