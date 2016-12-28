@extends('layouts.main')

@section('title', trans('modules.breadcrumbs.role',['role' => $role->name]) . ' -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('modules.breadcrumbs.role',['role' => $role->name])}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('user')}}">{{trans('modules.breadcrumbs.users')}}</a></li>
            <li><a href="{{route('user.roles')}}">{{trans('modules.breadcrumbs.roles')}}</a></li>
            <li class="active">{{trans('modules.breadcrumbs.role',['role' => $role->name])}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

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
                <h3 class="box-title">{{$role->name}} <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="{{trans('modules.menu.context.edit')}}"><i class="fa fa-edit"></i></a></h3>

                <div class="box-tools pull-right">
                    <div class="button-group">
                        <a class="btn btn-box-tool" href="{{route('user.roles')}}" title="{{trans('modules.menu.view.roles')}}"><i class="fa fa-th-list"></i></a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
            </div>
            <div class="box-body">

                <div><b>ID:</b> {{$role->id}}</div>
                <div><b>{{trans('user::form.slug')}}:</b> {{$role->slug}}</div>
                <div><b>{{trans('user::form.name')}}:</b> {{$role->name}}</div>
                <div><b>{{trans('user::form.description')}}:</b> {{$role->description}}</div>
                <div><b>{{trans('user::form.date')}}:</b> {{date('d.m.Y H:i', strtotime($role->updated_at))}}</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

            <!-- Default box -->
            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('modules.permissions')}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                        <form @if($checkEditPerm) action="{{route('user.roles.update.perms',['id' => $role->id])}}" method="post" @endif>
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <?php
                                    $checked = false;
                                    if(in_array($permission->slug, $rolePerms))
                                        $checked = true;
                                    ?>
                                    <div class="checkbox col-lg-3 col-md-4 col-sm-12">
                                        <label>
                                            <input type="checkbox" class="flat" name="permissions[{{$permission->slug}}]" value="{{$permission->id}}" @if($checked) checked @endif @if(!$checkEditPerm) disabled @endif> {{trans("user::permissions.".$permission->name)}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @if($checkEditPerm)
                                <button type="submit" class="btn btn-primary">{{trans('modules.menu.context.update')}}</button>
                            @endif
                        </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
