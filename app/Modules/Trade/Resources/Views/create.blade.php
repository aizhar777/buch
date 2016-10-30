@extends('layouts.main')

@section('title', 'Create trade -')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Add new trade</h3>
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


                    <form action="{{route('trade.store')}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}

                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Create trade form</h2>

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
                                                <a href="{{route('trade')}}">All trades</a>
                                            </li>
                                        </ul>

                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="status" class="select2_single form-control">
                                            @foreach($all_status as $status)
                                                <option value="{{$status->id}}" title="{{$status->description}}">{{$status->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Curator</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="curator" class="select2_single form-control">
                                            <option>Select curator</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Client</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="client_id" class="select2_single form-control" required>
                                            <option>Select client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase code</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="ppc" class="select2_single form-control">
                                            <option>Select PPC</option>
                                            @foreach($codes as $ppc)
                                                <option value="{{$ppc->id}}" title="{{$ppc->description}}">{{$ppc->code}}: {{str_limit($ppc->description, 80, '...')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select products</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="products[]" id="select_products" class="select2_multiple form-control" multiple="multiple">
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}" data-balance="{{$product->balance}}">{{$product->name}} price: {{number_format($product->price)}}; ({{$product->balance}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="options_block" style="margin: 0;padding: 0;"></div>

                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-large btn-primary" type="submit">Create</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
