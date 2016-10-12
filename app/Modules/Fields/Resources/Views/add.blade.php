@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> </h3>
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

                            <h2>Fields list</h2>

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
                                            <a href="{{route('fields.add')}}">Add field</a>
                                        </li>
                                        <li>
                                            <a href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete</a>
                                        </li>
                                    </ul>

                                </li>

                                <li>
                                    <a class="close-link"><i class="fa fa-close"></i></a>
                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <h2>Create New Field Params</h2>
                            <form action="{{route('fields.create')}}" method="post">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="field_is_required">Type</label>
                                    <select name="accessory_type" id="field_is_required" class="form-control" required>
                                        @if(!empty($types) and $types->count() > 0)
                                            <option value="none" selected="selected">Choose..</option>
                                            @foreach($types as $type)
                                                <option value="{{$type->class}}">{{$type->name}}</option>
                                            @endforeach
                                        @else
                                            <option>Error, try again later</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="field_name">Name</label>
                                    <input class="form-control" type="text" id="field_name" name="name" placeholder="Name field" value="{{old('name')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="field_slug">Slug</label>
                                    <input class="form-control" type="text" id="field_slug" name="slug" placeholder="Slug field" value="{{old('slug')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="field_default">Default</label>
                                    <input class="form-control" type="text" id="field_default" name="default_value" placeholder="Default value to field" value="{{old('default_value')}}" required>
                                    <span id="helpBlock" class="help-block">If you want a choice of several values, use the delimiter "<strong>|</strong>" For example: Machine|Valosiped|Helicopter. The first value is considered the default. And the "Is many values" should be as YES</span>
                                </div>

                                <div class="form-group">
                                    <label for="field_desc">Description</label>
                                    <textarea class="form-control"name="description" placeholder="Description field" id="field_desc" rows="3" required>{{old('description')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="field_is_many">Is many values</label>
                                    <select name="is_many_values" id="field_is_many" class="form-control" required>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="field_is_required">Is required</label>
                                    <select name="is_required" id="field_is_required" class="form-control" required>
                                        <option value="0">No</option>
                                        <option value="1" selected>Yes</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-default" type="submit">Create</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
