@extends('layouts.main')

@section('title', trans('modules.breadcrumbs.permission',['permission' => trans("user::permissions.".$perm->name)]) . ' -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('modules.breadcrumbs.permission',['permission' => trans("user::permissions.".$perm->name)])}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('user')}}">{{trans('modules.breadcrumbs.users')}}</a></li>
            <li><a href="{{route('user.perms')}}">{{trans('modules.breadcrumbs.permissions')}}</a></li>
            <li class="active">{{trans('modules.breadcrumbs.permission',['permission' => trans("user::permissions.".$perm->name)])}}</li>
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
                    <a class="btn btn-box-tool" href="{{route('user.perms')}}" title="{{trans('modules.menu.view.permissions')}}"><i class="fa fa-th-list"></i></a>
                    {{--
                    <a class="btn btn-box-tool" href="{{route('user.perms.edit',['id' => $perm->id])}}" title="{{trans('modules.menu.context.edit')}}"><i class="fa fa-pencil-square"></i></a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('perms-{{$perm->id}}-delete-form').submit();" title="{{trans('modules.menu.context.delete')}}"><i class="fa fa-trash"></i></a>
                    --}}
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
                @include('forms.role_perms_delete_form', ['id' => $perm->id, 'slug' => 'perms'])
            </div>
            <div class="box-body">
                <div><b>ID:</b> {{$perm->id}}</div>
                <div><b>{{trans('user::form.slug')}}:</b> {{$perm->slug}}</div>
                <div><b>{{trans('user::form.name')}}:</b> {{trans("user::permissions.".$perm->name)}}</div>
                <div><b>{{trans('user::form.description')}}:</b> {{$perm->description}}</div>
                <div><b>{{trans('user::form.date')}}:</b> {{date('d.m.Y H:i', strtotime($perm->updated_at))}}</div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <h3>{{trans('user::role_and_perms.available_for_role')}}:</h3>
                @foreach($perm->roles as $role)
                    <a href="{{route('user.roles.show_slug',['slug' => $role->slug ])}}" class="btn btn-small btn-default">{{trans('modules.breadcrumbs.role',['role' => $role->name])}} </a>
                @endforeach
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
