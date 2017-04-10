@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('products::module.module_links.create') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('products') }}">{{trans('products::module.module_name')}}</a></li>
            <li class="active">{{ trans('modules.menu.context.add') }}</li>
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

        <form action="{{route('products.data.create')}}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('products::module.form.create_form_label') }}</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('products')}}">{{ trans('products::module.module_links.all') }}</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="product_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.name') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name"  id="product_name" type="text" class="form-control" placeholder="{{ trans('products::module.form.name') }}" value="{{old('name')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_description" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.description') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="description" id="product_description" rows="10" class="form-control" placeholder="{{ trans('products::module.form.description') }}">{{old('description')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="product_price" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.price') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="price" id="product_price" type="text" class="form-control" placeholder="{{ trans('products::module.form.price') }}" value="{{old('price')}}">
                        </div>
                        <hr>
                        <label for="product_cost" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.cost') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="cost" id="product_cost" type="text" class="form-control" placeholder="{{ trans('products::module.form.cost') }}" value="{{old('cost')}}">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="product_cost" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.unit') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="cost" id="product_cost" type="text" class="form-control" placeholder="{{ trans('products::module.form.unit') }}">
                        </div>
                        <hr>

                        <label for="product_balance" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.balance') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="balance" min="1" id="product_balance" type="number" class="form-control" placeholder="{{ trans('products::module.form.balance') }}" value="{{old('balance') or 1 }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="product_is_service" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.is_a_service_label') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="is_service" id="product_is_service" class="form-control">
                                <option value="0" @if(old('is_service') == 0) selected @endif >{{ trans('modules.no') }}</option>
                                <option value="1" @if(old('is_service') == 1) selected @endif >{{ trans('modules.yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_stock" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.stock') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="product_stock" name="stock" class="form-control">
                                @if(!empty($stocks))
                                    @foreach($stocks as $stock)
                                        <option value="{{$stock->id}}" @if(old('stock') == $stock->id) selected @endif >{{$stock->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_subdivision" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('products::module.form.subdivision') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="product_subdivision" name="subdivision" class="form-control">
                                @if(!empty($subdivisions))
                                    @foreach($subdivisions as $subdivision)
                                        <option value="{{$subdivision->id}}" @if(old('subdivision') == $subdivision->id) selected @endif >{{$subdivision->name}}</option>
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
@endsection
