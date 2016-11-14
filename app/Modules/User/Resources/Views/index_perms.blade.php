@extends('layouts.main')

@section('title', 'Permissions -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Permissions
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Permissions</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">

                    <a class="btn btn-box-tool" title="Create new trade" href="{{route('user.perms.create')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(!empty($perms) and $perms->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @each('user::each.perms_table', $perms, 'permission')

                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>Permissions not found</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
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



    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="row">


                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">

                        <div class="x_content">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
