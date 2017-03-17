@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$storage->name or 'Error'}}
            <small>{{ trans('modules.menu.context.edit') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('stock') }}">{{trans('stock::module.module_links.all')}}</a></li>
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


        <form action="{{route('stock.update',['id' => $storage->id])}}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('stock::module.form.edit_stock_form') }}</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('stock.show',['id' => $storage->id])}}">{{ trans('stock::module.view.go_back') }}</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="stock_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('stock::module.form.name') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name"  id="stock_name" type="text" class="form-control" placeholder="{{ trans('stock::module.form.name') }}" value="{{$storage->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stock_slug" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('stock::module.form.slug') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="slug"  id="stock_slug" type="text" class="form-control" placeholder="{{ trans('stock::module.form.slug') }}" value="{{$storage->slug}}">
                            <span id="helpBlock" class="help-block">{{ trans('stock::module.form.only_latin_and_dashes') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stock_description" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('stock::module.form.desc') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="description" id="stock_description" rows="5" class="form-control" placeholder="{{ trans('stock::module.form.desc') }}">{{$storage->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stock_subdivision" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('stock::module.form.subdivision') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="stock_subdivision" name="subdivision_id" class="form-control">
                                <option>Choose subdivision</option>
                                @if(!empty($subdivisions))
                                    @foreach($subdivisions as $subdivision)
                                        <option value="{{$subdivision->id}}" @if($storage->subdivision_id == $subdivision->id) selected @endif >{{$subdivision->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="is_responsible" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('stock::module.form.add_responsible_checkbox') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="is_responsible"  id="is_responsible" type="checkbox" @if(!empty($storage->is_responsible)) checked @endif >
                        </div>
                    </div>

                    <div class="form-group" id="stock_responsible_wrap">
                        <label for="stock_responsible" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('stock::module.form.responsible') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="stock_responsible" name="responsible" class="form-control">
                                <option value="">Choose user</option>
                                @if(!empty($responsibles))
                                    @foreach($responsibles as $responsible)
                                        <option value="{{$responsible->id}}" @if($storage->responsible == $responsible->id) selected @endif >{{$responsible->name}}</option>
                                    @endforeach
                                @endif
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
