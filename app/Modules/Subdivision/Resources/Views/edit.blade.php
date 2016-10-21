@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit {{$subdivision->name or 'subdivision'}}</h3>
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


                    <form action="{{route('subdivision.update',['id' => $subdivision])}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Edit subdivision form</h2>

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
                                                <a href="{{route('subdivision.show',['id' => $subdivision->id])}}">Go back</a>
                                            </li>
                                            <li>
                                                <a href="{{route('subdivision')}}">All subdivisions</a>
                                            </li>
                                        </ul>

                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <div class="form-group">
                                    <label for="subdivision_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name subdivision</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="name"  id="subdivision_name" type="text" class="form-control" placeholder="Subdivision name" value="{{$subdivision->name}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subdivision_slug" class="control-label col-md-3 col-sm-3 col-xs-12">Slug subdivision</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="slug"  id="subdivision_slug" type="text" class="form-control" placeholder="Subdivision slug" value="{{$subdivision->slug}}">
                                        <span id="helpBlock" class="help-block">Only Latin characters and dashes "-" or "_"</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subdivision_description" class="control-label col-md-3 col-sm-3 col-xs-12">Description subdivision</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="description" id="subdivision_description" rows="5" class="form-control" placeholder="Subdivision description">{{$subdivision->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subdivision_address" class="control-label col-md-3 col-sm-3 col-xs-12">Subdivision address</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="address" id="subdivision_address" type="text" class="form-control" placeholder="Subdivision address" value="{{$subdivision->address}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_responsible_subdivision" class="control-label col-md-3 col-sm-3 col-xs-12">Add responseble for subdivision</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="is_responsible"  id="is_responsible_subdivision" type="checkbox" @if(!empty(old('is_responsible'))) checked @endif >
                                    </div>
                                </div>

                                <div class="form-group" id="subdivision_responsible_wrap">
                                    <label for="subdivision_responsible" class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="subdivision_responsible" name="responsible" class="form-control">
                                            <option value="">Choose user</option>
                                            @if(!empty($responsibles))
                                                @foreach($responsibles as $user)
                                                    <option value="{{$user->id}}" @if($subdivision->responsible == $user->id) selected @endif >{{$user->name}}</option>
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
