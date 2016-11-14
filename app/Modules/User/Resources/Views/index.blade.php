@extends('layouts.main')

@section('title', 'Trades -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    @include('block.flash_messages')

    <div class="content">

    @if(!empty($users) and $users->count() > 0)
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Table</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>UID</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Action</th>
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
            <h4>Info</h4>
            <p>Users not found</p>
        </div>
    @endif

    </div>
    <!-- /page content -->
@endsection
