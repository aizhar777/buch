@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit storage: {{$storage->name or 'Error'}}</h3>
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


                    <form action="{{route('stock.update',['id' => $storage->id])}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Edit form</h2>

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
                                                <a href="{{route('stock')}}">All stores</a>
                                            </li>
                                        </ul>

                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <div class="form-group">
                                    <label for="stock_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name storage</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="name"  id="stock_name" type="text" class="form-control" placeholder="Stock name" value="{{$storage->name}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="stock_slug" class="control-label col-md-3 col-sm-3 col-xs-12">Slug storage</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="slug"  id="stock_slug" type="text" class="form-control" placeholder="Stock slug" value="{{$storage->slug}}">
                                        <span id="helpBlock" class="help-block">Only Latin characters and dashes "-" or "_"</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="stock_description" class="control-label col-md-3 col-sm-3 col-xs-12">Description storage</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="description" id="stock_description" rows="5" class="form-control" placeholder="Stock description">{{$storage->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="stock_subdivision" class="control-label col-md-3 col-sm-3 col-xs-12">Subdivision storage</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="stock_subdivision" name="subdivision_id" class="form-control">
                                            <option>Choose subdivision</option>
                                            @if(!empty($subdivisions))
                                                @foreach($subdivisions as $subdivision)
                                                    <option value="{{$subdivision->id}}" @if($storage->subdivision_id == $subdivision->id) selected @endif >{{$subdivision->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="is_responsible" class="control-label col-md-3 col-sm-3 col-xs-12">Add responseble for storage</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="is_responsible"  id="is_responsible" type="checkbox" @if(!empty($storage->is_responsible)) checked @endif >
                                    </div>
                                </div>

                                <div class="form-group" id="stock_responsible_wrap">
                                    <label for="stock_responsible" class="control-label col-md-3 col-sm-3 col-xs-12">Responsible for storage</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="stock_responsible" name="responsible" class="form-control">
                                            <option value="">Choose user</option>
                                            @if(!empty($responsibles))
                                                @foreach($responsibles as $responsible)
                                                    <option value="{{$responsible->id}}" @if($storage->responsible == $responsible->id) selected @endif >{{$responsible->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <button class="btn btn-large btn-primary" type="submit">Update</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
