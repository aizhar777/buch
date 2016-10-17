@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Products</h3>
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
                                            <a href="{{route('products.create')}}">Add product</a>
                                        </li>
                                    </ul>

                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            @if(!empty($products) and $products->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Cost</th>
                                        <th>Is a service</th>
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
                                            <th>{{$product->name}}</th>
                                            <th>{{$product->description}}</th>
                                            <th>{{$product->price}}</th>
                                            <th>{{$product->cost}}</th>
                                            <th>
                                                @if($product->is_service)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </th>
                                            <th>{{$product->balance}}</th>
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
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
