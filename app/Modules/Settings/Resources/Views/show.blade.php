@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Settings</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                @include('block.flash_messages')

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>All</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">

                                    <a href="#"
                                       class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       role="button"
                                       aria-expanded="false">
                                        <i class="fa fa-wrench"></i>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="#{{route('settings')}}">Add settings</a>
                                        </li>
                                    </ul>

                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            @if(!empty($settings) and $settings->count() > 0)

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
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
                                                                <input type="checkbox" onclick="application.updateSettings('{{$setting->slug}}');" class="js-switch" @if($setting->value) checked @endif />
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
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
