@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('products::module.module_name')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('products::module.module_name')}}</li>
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
                <h3 class="box-title">{{ trans('products::module.list') }}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('products.create')}}">{{ trans('products::module.module_links.create') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($products) and $products->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('products::module.view.id') }}</th>
                            <th>{{ trans('products::module.view.name') }}</th>
                            <th>{{ trans('products::module.view.price') }}</th>
                            <th>{{ trans('products::module.view.cost') }}</th>
                            <th>{{ trans('products::module.view.balance') }}</th>
                            <th>{{ trans('products::module.view.stock') }}</th>
                            <th>{{ trans('products::module.view.date') }}</th>
                            <th>{{ trans('products::module.view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>{{$product->id}}</th>
                                <th title="{{ $product->description }}">{{$product->name}}</th>
                                <th>{{number_format($product->price,2,'.','&nbsp;') . ' ' . config('company.currency')}}</th>
                                <th>{{number_format($product->cost,2,'.','&nbsp;') . ' ' . config('company.currency')}}</th>
                                <th>
                                    @if($product->is_service)
                                        <span class="label label-default">{{ trans('products::module.is_service') }}</span>
                                    @else
                                        {{$product->balance}}
                                    @endif
                                </th>
                                <th>{{$product->stock->name or $product->stock_id}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($product->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-primary btn-round" href="{{route('products', ['id'=> $product->id])}}">{{ trans('modules.menu.view.view') }}</a>
                                        <a class="btn btn-sm btn-primary btn-round" href="{{route('products.edit', ['id'=> $product->id])}}">{{ trans('modules.menu.context.edit') }}</a>
                                        <a class="btn btn-sm btn-primary btn-round" onclick="event.preventDefault();document.getElementById('products-{{$product->id}}-delete-form').submit();">{{ trans('modules.menu.context.delete') }}</a>
                                    </div>
                                    @include('forms.products_delete_form', ['id' => $product->id])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>{{ trans('products::module.messages.not_found') }}</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                @if($products->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$products->appends(['items' => request('items')])->links()}}
                    @else
                        {{$products->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
