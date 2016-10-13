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
                            <?php
                                if(!$field instanceof \App\FieldParam){
                                    Flash::error('When editing the parameters of the field, there was an error, please try again later.');
                                    redirect()->back();
                                }
                            ?>
                            <form action="{{route('fields.data.edit',['id' => $field->id])}}" method="post">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="field_is_required">Type</label>
                                    <select name="accessory_type" id="field_is_required" class="form-control" required>
                                        @if(!empty($types) and $types->count() > 0)
                                            @foreach($types as $type)
                                                <option value="{{$type->class}}" @if($type->class == $field->accessory_type) selected @endif >{{$type->name}}</option>
                                            @endforeach
                                        @else
                                            <option>Error, try again later</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="field_name">Name</label>
                                    <input class="form-control" type="text" id="field_name" name="name" placeholder="Name field" value="{{$field->name}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="field_slug">Slug</label>
                                    <input class="form-control" type="text" id="field_slug" name="slug" placeholder="Slug field" value="{{$field->slug}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="field_default">Default</label>
                                    <input class="form-control" type="text" id="field_default" name="default_value" placeholder="Default value to field" value="{{$field->default_value}}" required>
                                    <span id="helpBlock" class="help-block">If you want a choice of several values, use the delimiter "<strong>|</strong>" For example: Machine|Valosiped|Helicopter. The first value is considered the default. And the "Is many values" should be as YES</span>
                                </div>

                                <div class="form-group">
                                    <label for="field_desc">Description</label>
                                    <textarea class="form-control"name="description" placeholder="Description field" id="field_desc" rows="3" required>{{$field->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="field_is_many">Is many values</label>
                                    <select name="is_many_values" id="field_is_many" class="form-control" required>
                                        <option value="0" @if(!$field->is_many_values) selected @endif >No</option>
                                        <option value="1" @if($field->is_many_values) selected @endif >Yes</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="field_is_required">Is required</label>
                                    <select name="is_required" id="field_is_required" class="form-control" required>
                                        <option value="0" @if(!$field->is_required) selected @endif >No</option>
                                        <option value="1" @if($field->is_required) selected @endif >Yes</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-default" type="submit">Edit</button>
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
