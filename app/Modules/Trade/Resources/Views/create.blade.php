@extends('layouts.main')

@section('title', trans('trade::module.module_links.create') . ' -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('trade::module.module_name') }}
            <small>{{ trans('modules.menu.context.add') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('trade')}}">{{trans('modules.breadcrumbs.trades')}}</a></li>
            <li class="active">{{ trans('modules.menu.context.create') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


            <!-- Default box -->
            <div class="box">
                <form action="{{route('trade.store')}}" method="post">
                    {{csrf_field()}}

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('trade::module.forms.form_title_create') }}</h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-box-tool" href="{{route('trade')}}">{{ trans('trade::module.module_links.all') }}</a>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">

                        <div class="form-group">
                            <label for="trade_status" class="control-label">{{ trans('trade::module.forms.input_status_label') }}</label>
                            <select id="trade_status" name="status" class="form-control select2">
                                @foreach($all_status as $status)
                                    <option value="{{$status->id}}" title="{{$status->description}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trade_curator" class="control-label">{{ trans('trade::module.forms.input_curator_label') }}</label>
                            <select id="trade_curator" name="curator" class="form-control select2">
                                <option>{{ trans('trade::module.forms.input_curator_placeholder') }}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trade_client" class="control-label">{{ trans('trade::module.forms.input_client_label') }}</label>
                            <select id="trade_client" name="client_id" class="form-control select2" required>
                                <option>{{ trans('trade::module.forms.input_client_placeholder') }}</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trade_ppc" class="control-label">{{ trans('trade::module.forms.input_ppc_label') }}</label>
                            <select id="trade_ppc" name="ppc" class="form-control select2">
                                <option>{{ trans('trade::module.forms.input_ppc_placeholder') }}</option>
                                @foreach($codes as $ppc)
                                    <option value="{{$ppc->id}}" title="{{$ppc->description}}">{{$ppc->code}}: {{str_limit($ppc->description, 80, '...')}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-large btn-primary" type="submit">{{ trans('modules.menu.context.create') }}</button>
                    </div>
                <!-- /.box-footer-->
                </form>
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
