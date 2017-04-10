@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$product->name or 'Error'}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('products') }}">{{trans('products::module.module_name')}}</a></li>
            <li class="active">{{$product->name or 'Error'}}</li>
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

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{($product->is_service)? trans('products::module.title_service',['name' => $product->name]) : trans('products::module.title_product',['name' => $product->name]) }}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('products')}}">{{ trans('products::module.module_links.all') }}</a>
                    <a class="btn btn-box-tool" href="{{route('products.edit',['id' => $product->id])}}">{{ trans('modules.menu.context.edit') }}</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('products-{{$product->id}}-delete-form').submit();">{{ trans('modules.menu.context.delete') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
                @include('forms.products_delete_form', ['id' => $product->id])
            </div>
            <div class="box-body">
                <div><b>{{ trans('products::module.view.name') }}:</b> {{$product->name}}</div>
                <div><b>{{ trans('products::module.view.description') }}:</b> {{$product->description}}</div>
                <div><b>{{ trans('products::module.view.price') }}:</b> {{number_format($product->price,2,'.','&nbsp;') . ' ' . config('company.currency')}}</div>
                <div><b>{{ trans('products::module.view.cost') }}:</b> {{number_format($product->cost,2,'.','&nbsp;') . ' ' . config('company.currency')}}</div>
                <div><b>{{ trans('products::module.view.unit') }}:</b> {{$product->unit}}</div>
                <div><b>{{ trans('products::module.view.balance') }}:</b>
                    @if($product->is_service)
                        <span class="label label-default">{{ trans('products::module.is_service') }}</span>
                    @else
                        {{$product->balance}}
                    @endif
                </div>
                <div><b>{{ trans('products::module.view.stock') }}:</b> {{$product->stock->name or $product->stock_id}}</div>
                <div><b>{{ trans('products::module.view.subdivision') }}:</b> {{$product->subdivision->name or $product->subdivision_id}}</div>
                <div><b>{{ trans('products::module.view.date') }}:</b> {{date('d.m.Y H:i', strtotime($product->created_at))}}</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
