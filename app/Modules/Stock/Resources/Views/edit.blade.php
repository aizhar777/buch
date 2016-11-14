@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit storage: {{$storage->name or 'Error'}}
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


        <form action="{{route('stock.update',['id' => $storage->id])}}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit form</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

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
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-large btn-primary" type="submit">Update</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
