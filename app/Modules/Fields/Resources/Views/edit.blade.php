@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Field: {{$field->name}}
            <small>edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Fields</a></li>
            <li><a href="#">{{$field->name}}</a></li>
            <li class="active">edit</li>
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

        <?php
        //TODO: ????????????????????????????
        if(!$field instanceof \App\FieldParam){
            Flash::error('When editing the parameters of the field, there was an error, please try again later.');
            redirect()->back();
        }
        ?>
        <form action="{{route('fields.data.edit',['id' => $field->id])}}" method="post">
            {{csrf_field()}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Create New Field Params</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div>
                <div class="box-body">

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

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default" type="submit">Update</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
