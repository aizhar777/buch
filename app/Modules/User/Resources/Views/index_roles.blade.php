@extends('layouts.main')

@section('title', 'Roles -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('user::module.roles')}}
            <small>{{trans('user::module.list')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('user')}}">{{trans('modules.breadcrumbs.users')}}</a></li>
            <li class="active">{{trans('modules.breadcrumbs.roles')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('user::module.roles')}}</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('user.roles.create') }}" class="btn btn-box-tool" data-toggle="tooltip" title="{{trans('user::role_and_perms.create_role')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($roles) and $roles->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{trans('user::form.name')}}</th>
                            <th>{{trans('user::form.slug')}}</th>
                            <th>{{trans('user::form.description')}}</th>
                            <th>{{trans('user::form.date')}}</th>
                            <th>{{trans('user::form.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @each('user::each.roles_table', $roles, 'role')

                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>{{trans('user::role_and_perms.roles_not_found')}}</h4>
                    </div>
                @endif
            </div>
            @if($roles->total() > 1 )
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="allTotal">{{trans('user::module.total',['total' => $roles->total()])}}</div>

                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$roles->appends(['items' => request('items')])->links()}}
                    @else
                        {{$roles->links()}}
                    @endif
                </div>
                <!-- /.box-footer-->
            @endif
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
