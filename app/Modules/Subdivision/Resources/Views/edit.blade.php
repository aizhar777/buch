@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$subdivision->name or 'subdivision'}}
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Subdivisions</a></li>
            <li><a href="#">{{$subdivision->name or 'subdivision'}}</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('block.flash_messages')


    <form action="{{route('subdivision.update',['id' => $subdivision])}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('subdivision.show',['id' => $subdivision->id])}}">Go back</a>
                    <a class="btn btn-box-tool" href="{{route('subdivision')}}">All subdivisions</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label for="subdivision_name" class="control-label">Name subdivision</label>
                    <input name="name"  id="subdivision_name" type="text" class="form-control" placeholder="Subdivision name" value="{{$subdivision->name}}">
                </div>

                <div class="form-group">
                    <label for="subdivision_slug" class="control-label">Slug subdivision</label>
                    <input name="slug"  id="subdivision_slug" type="text" class="form-control" placeholder="Subdivision slug" value="{{$subdivision->slug}}">
                    <span id="helpBlock" class="help-block">Only Latin characters and dashes "-" or "_"</span>
                </div>

                <div class="form-group">
                    <label for="subdivision_description" class="control-label">Description subdivision</label>
                    <textarea name="description" id="subdivision_description" rows="5" class="form-control" placeholder="Subdivision description">{{$subdivision->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="subdivision_address" class="control-label">Subdivision address</label>
                    <input name="address" id="subdivision_address" type="text" class="form-control" placeholder="Subdivision address" value="{{$subdivision->address}}">
                </div>

                <div class="form-group">
                    <label for="is_responsible_subdivision" class="control-label">Add responseble for subdivision</label>
                    <input name="is_responsible"  id="is_responsible_subdivision" type="checkbox" @if(!empty(old('is_responsible'))) checked @endif >
                </div>

                <div class="form-group" id="subdivision_responsible_wrap">
                    <label for="subdivision_responsible" class="control-label">&nbsp;</label>
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
