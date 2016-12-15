@extends('layouts.main')

@section('title', trans('user::module.permissions') . ' -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('user::module.permissions')}}
            <small>{{trans('user::module.list')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('user')}}">{{trans('modules.breadcrumbs.users')}}</a></li>
            <li class="active">{{trans('modules.breadcrumbs.permissions')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('user::module.permissions')}}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(!empty($perms) and $perms->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{trans('user::form.name')}}</th>
                            <th>{{trans('user::form.description')}}</th>
                            <th>{{trans('user::form.date')}}</th>
                            <th>{{trans('user::form.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                            @each('user::each.perms_table', $perms, 'permission')

                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>{{trans('user::role_and_perms.permissions_not_found')}}</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="allTotal">{{trans('user::module.total',['total' => $perms->total()])}}</div>
                @if($perms->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$perms->appends(['items' => request('items')])->links()}}
                    @else
                        {{$perms->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
