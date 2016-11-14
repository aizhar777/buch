@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editing: {{$product->name}}
            <small>it all starts here</small>
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

        <form action="{{route('products.data.edit',['id' => $product->id])}}" method="post" class="form-horizontal form-label-left">
        {{csrf_field()}}
        {{method_field('PUT')}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit product form</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('products')}}">All products</a>
                        <a class="btn btn-box-tool" href="{{route('products.create')}}">Add product</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="product_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name" id="product_name" type="text" class="form-control" placeholder="Product Name" value="{{$product->name or 'Error'}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="description" id="product_description" rows="10" class="form-control" placeholder="Product description">{{$product->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="product_price" class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="price" id="product_price" type="text" class="form-control" placeholder="Product price" value="{{$product->price}}">
                        </div>
                        <hr>
                        <label for="product_cost" class="control-label col-md-3 col-sm-3 col-xs-12">Cost</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="cost" id="product_cost" type="text" class="form-control" placeholder="Product price" value="{{$product->cost}}">
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="product_balance" class="control-label col-md-3 col-sm-3 col-xs-12">Balance</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="balance" min="1" id="product_balance" type="number" class="form-control" placeholder="Product balance" value="{{$product->balance or 1 }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="product_is_service" class="control-label col-md-3 col-sm-3 col-xs-12">Is a service</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="is_service" id="product_is_service" class="form-control">
                                <option value="0" @if($product->is_service == 0) selected @endif >No</option>
                                <option value="1" @if($product->is_service == 1) selected @endif >Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_stock" class="control-label col-md-3 col-sm-3 col-xs-12">Product stock</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="product_stock" name="stock" class="form-control">
                                <option>Choose stock</option>
                                @if(!empty($stocks))
                                    @foreach($stocks as $stock)
                                        <option value="{{$stock->id}}" @if($product->stock_id == $stock->id) selected @endif >{{$stock->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_subdivision" class="control-label col-md-3 col-sm-3 col-xs-12">Product subdivision</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="product_subdivision" name="subdivision" class="form-control">
                                <option>Choose subdivision</option>
                                @if(!empty($subdivisions))
                                    @foreach($subdivisions as $subdivision)
                                        <option value="{{$subdivision->id}}" @if($product->subdivision_id == $subdivision->id) selected @endif >{{$subdivision->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-large btn-primary" type="submit">Edit</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
