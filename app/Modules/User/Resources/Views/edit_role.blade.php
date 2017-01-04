@extends('layouts.main')

@section('title', 'Edit Role -')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('modules.breadcrumbs.role',['role' => $role->name]) }}
            <small>{{ trans('modules.menu.context.edit') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('modules.breadcrumbs.dashboard') }}</a></li>
            <li><a href="{{ route('user') }}">{{ trans('modules.breadcrumbs.users') }}</a></li>
            <li><a href="{{ route('user.roles') }}">{{ trans('modules.breadcrumbs.roles') }}</a></li>
            <li><a href="{{ route('user.roles.show_slug',['slug' => $role->slug]) }}">{{ trans('modules.breadcrumbs.role',['role' => $role->name]) }}</a></li>
            <li class="active">{{ trans('modules.menu.context.edit') }}</li>
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

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $role->name }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <form action="{{route('user.roles.update',['id' => $role->id])}}" method="post" class="form-horizontal form-label-left">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="box-body">

                    <div class="form-group">
                        <label for="role_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user::form.role.name') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name"  id="role_name" type="text" class="form-control" placeholder="{{ trans('user::form.role.name') }}" value="{{ $role->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role_slug" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user::form.role.slug') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="slug"  id="role_slug" type="text" class="form-control" placeholder="{{ trans('user::form.role.slug') }}" value="{{ $role->slug }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role_desc" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user::form.role.description') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control" name="description" id="role_desc" rows="5" placeholder="{{ trans('user::form.role.description') }}">{{ $role->description }}</textarea>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-large btn-primary pull-right" type="submit">{{trans('modules.menu.context.update')}}</button>
                    <div class="clearfix"></div>
                </div>
                <!-- /.box-footer-->
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
