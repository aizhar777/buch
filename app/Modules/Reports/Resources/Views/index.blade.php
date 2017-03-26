@extends('layouts.main')

@section('title',  trans('reports::module.module_name') . ' -')
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
                application.message("{{ trans('reports::module.messages.result_creation') }}",data.message,data.status);
            });
        }
    </script>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('reports::module.module_name') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('reports::module.module_links.all')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('reports::module.list') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($reports) and $reports->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('reports::module.view.id_report') }}</th>
                                <th>{{ trans('reports::module.view.date') }}</th>
                                <th>{{ trans('reports::module.view.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        @each('reports::each.reports_table', $reports, 'report')

                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info">
                        <h4>{{ trans('reports::module.messages.report_not_found') }}</h4>
                        <button type="button" class="btn btn-default" onclick="createReport();">
                            <i class="fa phpdebugbar-fa-plus"></i> {{ trans('reports::module.module_links.create') }}
                        </button>
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
