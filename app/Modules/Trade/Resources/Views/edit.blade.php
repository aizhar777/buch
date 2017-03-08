@extends('layouts.main')

@section('title', trans('trade::module.trade_edit_title',['id' => $trade->id]))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('trade::module.trade_edit_title',['id' => $trade->id]) }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('trade')}}">{{trans('modules.breadcrumbs.trades')}}</a></li>
            <li><a href="{{route('trade.show',['id' => $trade->id])}}">{{ trans('trade::module.trade_title',['id' => $trade->id]) }}</a></li>
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

        <form action="{{route('trade.update', ['id' => $trade->id ])}}" method="post" class="form-horizontal form-label-left">
        {{csrf_field()}}
        {{method_field('PUT')}}
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('trade::module.forms.form_title') }}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('trade.show',['id' => $trade->id])}}">{{ trans('trade::module.view.back_to_trade') }}</a>
                    <a class="btn btn-box-tool" href="{{route('trade')}}">{{ trans('trade::module.module_name') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('trade::module.forms.input_status_label') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="status" class="select2 form-control">
                            @foreach($all_status as $status)
                                <option value="{{$status->id}}" title="{{$status->description}}" @if($status->id == $trade->status) selected @endif >{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('trade::module.forms.input_curator_label') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="curator" class="select2 form-control">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($user->id == $trade->curator) selected @endif >{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('trade::module.forms.input_client_label') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="client_id" class="select2 form-control" required>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}" @if($client->id == $trade->client_id) selected @endif >{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('trade::module.forms.input_ppc_label') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="ppc" class="select2 form-control">
                            @foreach($codes as $ppc)
                                <option value="{{$ppc->id}}" title="{{$ppc->description}}" @if($ppc->id == $trade->ppc) selected @endif >
                                    {{ $ppc->code }} : {{ str_limit($ppc->description, 80, '...') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-large btn-primary" type="submit">{{ trans('modules.menu.context.update') }}</button>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
