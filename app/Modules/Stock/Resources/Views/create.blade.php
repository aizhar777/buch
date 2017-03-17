@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('stock::module.module_links.create') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('stock') }}">{{trans('stock::module.module_links.all')}}</a></li>
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

        <form action="{{route('stock.store')}}" method="post">
        {{csrf_field()}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('stock::module.form.create_stock_form') }}</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('stock')}}">{{ trans('stock::module.module_links.all') }}</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="stock_name" class="control-label">{{ trans('stock::module.form.name') }}</label>
                        <input name="name"  id="stock_name" type="text" class="form-control" placeholder="{{ trans('stock::module.form.name') }}" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="stock_slug" class="control-label">{{ trans('stock::module.form.slug') }}</label>
                        <input name="slug"  id="stock_slug" type="text" class="form-control" placeholder="{{ trans('stock::module.form.slug') }}" value="{{old('slug')}}">
                        <span id="helpBlock" class="help-block">{{ trans('stock::module.form.only_latin_and_dashes') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="stock_description" class="control-label">{{ trans('stock::module.form.desc') }}</label>
                        <textarea name="description" id="stock_description" rows="5" class="form-control" placeholder="{{ trans('stock::module.form.desc') }}">{{old('description')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="stock_subdivision" class="control-label">{{ trans('stock::module.form.subdivision') }}</label>
                        <select id="stock_subdivision" name="subdivision_id" class="form-control">
                            <option>Choose subdivision</option>
                            @if(!empty($subdivisions))
                                @foreach($subdivisions as $subdivision)
                                    <option value="{{$subdivision->id}}" @if(old('subdivision_id') == $subdivision->id) selected @endif >{{$subdivision->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="is_responsible" class="control-label">{{ trans('stock::module.form.add_responsible_checkbox') }}</label>
                        <input name="is_responsible"  id="is_responsible" type="checkbox" @if(!empty(old('is_responsible'))) checked @endif >
                    </div>

                    <div class="form-group" id="stock_responsible_wrap">
                        <label for="stock_responsible" class="control-label">{{ trans('stock::module.form.responsible') }}</label>
                        <select id="stock_responsible" name="responsible" class="form-control">
                            <option value="">Choose user</option>
                            @if(!empty($responsibles))
                                @foreach($responsibles as $responsible)
                                    <option value="{{$responsible->id}}" @if(old('responsible') == $responsible->id) selected @endif >{{$responsible->name}}</option>
                                @endforeach
                            @endif
                        </select>
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
@endsection
