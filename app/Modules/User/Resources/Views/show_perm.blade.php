@extends('layouts.main')

@section('title', 'Permission ' . $perm->name . ' -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans("user::permissions.".$perm->name)}}
            <small>Permission</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Permissions</a></li>
            <li class="active">{{trans("user::permissions.".$perm->name)}}</li>
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
                <h3 class="box-title">{{trans("user::permissions.".$perm->name)}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('user.perms')}}" title="All trades"><i class="fa fa-th-list"></i></a>
                    <a class="btn btn-box-tool" href="{{route('user.perms.edit',['id' => $perm->id])}}" title="Edit"><i
                                class="fa fa-pencil-square"></i></a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('perms-{{$perm->id}}-delete-form').submit();"
                       title="Delete"><i class="fa fa-trash"></i></a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
                @include('forms.role_perms_delete_form', ['id' => $perm->id, 'slug' => 'perms'])
            </div>
            <div class="box-body">
                <div><b>ID:</b> {{$perm->id}}</div>
                <div><b>SLUG:</b> {{$perm->slug}}</div>
                <div><b>Name:</b> {{trans("user::permissions.".$perm->name)}}</div>
                <div><b>Name:</b> {{$perm->description}}</div>
                <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($perm->updated_at))}}</div>
                <div>
                    <h3>Available for roles:</h3>
                    @foreach($perm->roles as $role)
                        <a href="{{route('user.roles.show_slug',['slug' => $role->slug ])}}" class="btn btn-small btn-success">{{$role->name}} </a>
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
