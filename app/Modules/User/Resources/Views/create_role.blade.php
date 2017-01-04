@extends('layouts.main')

@section('title', 'Create Role -')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('user::role_and_perms.create_role') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('modules.breadcrumbs.dashboard') }}</a></li>
            <li><a href="{{ route('user') }}">{{ trans('modules.breadcrumbs.users') }}</a></li>
            <li><a href="{{ route('user.roles') }}">{{ trans('modules.breadcrumbs.roles') }}</a></li>
            <li class="active">{{ trans('modules.menu.context.create') }}</li>
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
                <h3 class="box-title">{{ trans('user::role_and_perms.new_role') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <form action="{{route('user.roles.store')}}" method="post" class="form-horizontal form-label-left">
                {{csrf_field()}}
            <div class="box-body">

                <div class="form-group">
                    <label for="role_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user::form.role.name') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="name"  id="role_name" type="text" class="form-control" placeholder="{{ trans('user::form.role.name') }}" value="{{old('name')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="role_slug" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user::form.role.slug') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="slug"  id="role_slug" type="text" class="form-control" placeholder="{{ trans('user::form.role.slug') }}" value="{{old('slug')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="role_desc" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user::form.role.description') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" name="description" id="role_desc" rows="5" placeholder="{{ trans('user::form.role.description') }}">{{old('description')}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="role_special" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user::form.role.has_role_label') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <label for="role_special" style="font-weight: normal;">
                            <input type="checkbox" id="role_special" name="create_has_role"> {{ trans('user::form.role.has_role') }}
                        </label>


                        @if(!empty($roles) && $roles->count() > 0)

                            <div id="has-role-create" style="display: none">
                                <hr>
                                <select name="has_role" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role->slug}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-large btn-primary pull-right" type="submit">{{trans('modules.menu.context.create')}}</button>
                <div class="clearfix"></div>
            </div>
            <!-- /.box-footer-->
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
