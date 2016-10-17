@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Editing: {{$product->name}}</h3>
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

                @if (count($errors) > 0)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">

                    @include('block.flash_messages')


                    <form action="{{route('products.data.edit',['id' => $product->id])}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Edit product form</h2>

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
                                                <a href="{{route('products')}}">All products</a>
                                            </li>
                                            <li>
                                                <a href="{{route('products.create')}}">Add product</a>
                                            </li>
                                        </ul>

                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

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
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <button class="btn btn-large btn-primary" type="submit">Edit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
