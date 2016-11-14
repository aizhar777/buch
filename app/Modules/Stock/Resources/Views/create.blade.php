@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add new storage
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Stores</a></li>
            <li class="active">Add</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('block.flash_messages')

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('stock.store')}}" method="post">
        {{csrf_field()}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Create storage form</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('stock')}}">All stores</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="stock_name" class="control-label">Name storage</label>
                        <input name="name"  id="stock_name" type="text" class="form-control" placeholder="Stock name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="stock_slug" class="control-label">Slug storage</label>
                        <input name="slug"  id="stock_slug" type="text" class="form-control" placeholder="Stock slug" value="{{old('slug')}}">
                        <span id="helpBlock" class="help-block">Only Latin characters and dashes "-" or "_"</span>
                    </div>

                    <div class="form-group">
                        <label for="stock_description" class="control-label">Description storage</label>
                        <textarea name="description" id="stock_description" rows="5" class="form-control" placeholder="Stock description">{{old('description')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="stock_subdivision" class="control-label">Subdivision storage</label>
                        <select id="stock_subdivision" name="subdivision_id" class="form-control">
                            <option>Choose subdivision</option>
                            @if(!empty($subdivisions))
                                @foreach($subdivisions as $subdivision)
                                    <option value="{{$subdivision->id}}" @if(old('subdivision_id') == $subdivision->id) selected @endif >{{$subdivision->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="is_responsible" class="control-label">Add responseble for storage</label>
                        <input name="is_responsible"  id="is_responsible" type="checkbox" @if(!empty(old('is_responsible'))) checked @endif >
                    </div>

                    <div class="form-group" id="stock_responsible_wrap">
                        <label for="stock_responsible" class="control-label">Responsible for storage</label>
                        <select id="stock_responsible" name="responsible" class="form-control">
                            <option value="">Choose user</option>
                            @if(!empty($responsibles))
                                @foreach($responsibles as $responsible)
                                    <option value="{{$responsible->id}}" @if(old('responsible') == $responsible->id) selected @endif >{{$responsible->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-large btn-primary" type="submit">Create</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
