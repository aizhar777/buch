@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
            <small>site</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li class="active">all</li>
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
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    <a class="btn btn-box-tool" href="#{{route('settings')}}">Add settings</a>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($settings) and $settings->count() > 0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Clear cache</th>
                            <th><a href="{{ route('clearCache') }}">Clear</a></th>
                        </tr>
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
                                                <span id="helpBlock" class="help-block">{{$setting->description}}</span>
                                            </div>
                                        @else
                                            <div class="input-group" id="id_settings_{{$setting->slug}}">
                                                <input type="text" class="form-control" value="{{$setting->value}}" placeholder="{{$setting->value}}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-small btn-primary" onclick="application.updateSettings('{{$setting->slug}}');"><i class="fa fa-refresh"></i></button>
                                                </span>
                                            </div>
                                            <span id="helpBlock" class="help-block">{{$setting->description}}</span>
                                        @endif

                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info">
                        <h4>Settings not found</h4>
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
