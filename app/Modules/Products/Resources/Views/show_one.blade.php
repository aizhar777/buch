@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{$product->name or 'Error'}}</h3>
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

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Product: {{$product->name or 'Error'}}</h2>

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
                                            <a href="{{route('products')}}">All clients</a>
                                        </li>
                                        <li>
                                            <a href="{{route('products.edit',['id' => $product->id])}}">Edit</a>
                                        </li>
                                        <li>
                                            <a onclick="event.preventDefault();document.getElementById('products-{{$product->id}}-delete-form').submit();">Delete</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            @include('forms.products_delete_form', ['id' => $product->id])

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div><b>Name:</b> {{$product->name}}</div>
                            <div><b>Description:</b> {{$product->description}}</div>
                            <div><b>Price:</b> {{$product->price}}</div>
                            <div><b>Cost:</b> {{$product->cost}}</div>
                            <div><b>Is a service:</b>
                                @if($product->is_service)
                                    Yes
                                @else
                                    No
                                @endif
                            </div>
                            <div><b>Balance:</b> {{$product->balance}}</div>
                            <div><b>Stock:</b> {{$product->stock->name or $product->stock_id}}</div>
                            <div><b>Subdivision:</b> {{$product->subdivision->name or $product->subdivision_id}}</div>
                            <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($product->created_at))}}</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
