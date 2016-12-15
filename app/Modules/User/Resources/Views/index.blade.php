@extends('layouts.main')

@section('title', trans('modules.breadcrumbs.users') . ' -')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{trans('modules.breadcrumbs.users')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('modules.breadcrumbs.users')}}</li>
        </ol>
    </section>

    @include('block.flash_messages')

    <div class="content">
    @if(!empty($users) and $users->count() > 0)
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('modules.breadcrumbs.users')}}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>UID</th>
                            <th>{{trans('user::module.role')}}</th>
                            <th>{{trans('user::module.name')}}</th>
                            <th>{{trans('user::module.email')}}</th>
                            <th>{{trans('user::module.date')}}</th>
                            <th>{{trans('user::module.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @each('user::each.users_table', $users, 'user')

                        </tbody>
                    </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                @if($users->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$users->appends(['items' => request('items')])->links()}}
                    @else
                        {{$users->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    @else
        <div class="callout callout-info">
            <h4>{{trans('user::module.info')}}</h4>
            <p>{{trans('user::module.users_not_isset')}}</p>
        </div>
    @endif

    </div>
    <!-- /page content -->
@endsection
