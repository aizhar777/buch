@extends('layouts.main')

@section('title') Edit User @endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$user->name or 'No name'}}
            <small>{{$user->email or ''}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dasboard</a></li>
            <li><a href="{{route('user')}}">Users</a></li>
            <li><a href="{{route('user',['id' => $user->id])}}">{{$user->name or 'No name'}}</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')


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

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Update {{$user->name or 'No name'}}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form action="{{route('user.edit.post',$user->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label>You'r name</label>
                        <input class="form-control" type="text" name="name" value="{{$user->name}}" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email" value="{{$user->email}}" placeholder="E-Mail">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-control" type="file" name="user_image" placeholder="Change photo">
                    </div>

                    @if(!empty($fields))
                        @foreach($fields as $key => $value)
                            @if($value['is_many'])
                                @if(!$value['is_hidden'])
                                    <div class="form-group">
                                        <label>{{$key}}</label>
                                        <select class="form-control" name="fields[{{$key}}]" id="{{$key}}" @if($value['is_required']) required @endif >
                                            <option value="*">Select {{$key}}</option>
                                            @foreach($value['default'] as $k => $v)
                                                <option value="{{$v}}" @if($v == $value['data']) selected="selected" @endif >{{$v}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @else
                                @if(!$value['is_hidden'])
                                    <div class="form-group">
                                        <label>{{$value['name']}}</label>
                                        <input class="form-control" type="text" name="fields[{{$key}}]" value="{{$value['data']}}" placeholder="{{$value['name']}}" @if($value['is_required']) required @endif >
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                    <div class="form-group">
                        <button class="btn btn-default">Send</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                fasf
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
