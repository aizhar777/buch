@extends('layouts.main')

@section('title', 'Reports -')
@section('scripts')
    <script>
        function createReport() {
            $.ajax({
                url: "{{route('reports.store')}}",
                method: "POST",
                data: {
                    "report": "generate"
                }
            }).done(function (res) {
                var data = JSON.parse(res);
                application.message('Result creation report',data.message,data.status);
            });
        }
    </script>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reports
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Reports</a></li>
            <li class="active">list</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($reports) and $reports->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @each('reports::each.reports_table', $reports, 'report')

                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info">
                        <h4>Reports are not created</h4>
                        <button type="button" class="btn btn-default" onclick="createReport();"><i class="fa phpdebugbar-fa-plus"></i> Create report</button>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($reports->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$reports->appends(['items' => request('items')])->links()}}
                    @else
                        {{$reports->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
