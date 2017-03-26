@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('settings::module.module_name')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('settings::module.module_name')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('settings::module.list') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($settings) and $settings->count() > 0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('settings::module.view.name') }}</th>
                            <th>{{ trans('settings::module.view.value') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <th>{{$setting->name}}</th>
                                <th>
                                    <div class="btn-group">
                                        @if($setting->is_bool)
                                            <div class="form-group">
                                                <label id="id_settings_{{$setting->slug}}">
                                                    <input type="checkbox" class="settings_switch" data-slug="{{$setting->slug}}" @if($setting->value) checked @endif />
                                                    @if($setting->value)
                                                        <span class="check_label">ON</span>
                                                    @else
                                                        <span class="check_label">OFF</span>
                                                    @endif
                                                </label>
                                                @if(!empty($setting->description))<span id="helpBlock" class="help-block">{{$setting->description}}</span> @endif
                                            </div>
                                        @else
                                            <div class="input-group" id="id_settings_{{$setting->slug}}">
                                                <input type="text" class="form-control" value="{{$setting->value}}" placeholder="{{$setting->value}}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-small btn-primary" onclick="application.updateSettings('{{$setting->slug}}');"><i class="fa fa-refresh"></i></button>
                                                </span>
                                            </div>
                                            @if(!empty($setting->description)) <span id="helpBlock" class="help-block">{{$setting->description}}</span> @endif
                                        @endif

                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info">
                        <h4>{{ trans('settings::module.view.settings_not_found') }}</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                @if($settings->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$settings->appends(['items' => request('items')])->links()}}
                    @else
                        {{$settings->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
