@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('subdivision::module.module_links.create') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('subdivision') }}">{{trans('subdivision::module.module_links.all')}}</a></li>
            <li class="active">{{ trans('modules.menu.context.add') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('block.flash_messages')

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('subdivision.store')}}" method="post" class="form-horizontal form-label-left">
        {{csrf_field()}}
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('subdivision::module.form.create_subdivision_form') }}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('subdivision')}}">{{ trans('subdivision::module.module_links.all') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label for="subdivision_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('subdivision::module.form.name') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="name"  id="subdivision_name" type="text" class="form-control" placeholder="{{ trans('subdivision::module.form.name') }}" value="{{old('name')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subdivision_slug" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('subdivision::module.form.slug') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="slug"  id="subdivision_slug" type="text" class="form-control" placeholder="{{ trans('subdivision::module.form.slug') }}" value="{{old('slug')}}">
                        <span id="helpBlock" class="help-block">{{ trans('subdivision::module.form.only_latin_and_dashes') }}"</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="subdivision_description" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('subdivision::module.form.desc') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea name="description" id="subdivision_description" rows="5" class="form-control" placeholder="{{ trans('subdivision::module.form.desc') }}">{{old('description')}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="subdivision_address" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('subdivision::module.form.address') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="address" id="subdivision_address" type="text" class="form-control" placeholder="{{ trans('subdivision::module.form.address') }}" value="{{old('address')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="is_responsible_subdivision" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('subdivision::module.form.add_responsible_checkbox') }}</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input name="is_responsible"  id="is_responsible_subdivision" type="checkbox" @if( !empty(old('is_responsible')) ) checked @endif >
                    </div>
                </div>

                <div class="form-group" id="subdivision_responsible_wrap">
                    <label for="subdivision_responsible" class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select id="subdivision_responsible" name="responsible" class="form-control">
                            <option value="">{{ trans('subdivision::module.form.responsible') }}</option>
                            @if(!empty($responsibles))
                                @foreach($responsibles as $user)
                                    <option value="{{$user->id}}" @if(old('responsible') == $user->id) selected @endif >{{$user->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-large btn-primary" type="submit">{{ trans('modules.menu.context.create') }}</button>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->








    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">



                        <div class="x_panel">
                            <div class="x_title">

                                <h2></h2>

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
                                            </li>
                                        </ul>

                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                        </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
