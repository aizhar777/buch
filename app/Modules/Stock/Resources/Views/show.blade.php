@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$stock->name or 'Error'}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('stock') }}">{{trans('stock::module.module_links.all')}}</a></li>
            <li class="active">{{$stock->name or 'Error'}}</li>
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

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$stock->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('stock')}}">{{trans('stock::module.module_links.all')}}</a>
                    <a class="btn btn-box-tool" href="{{route('stock.edit',['id' => $stock->id])}}">{{ trans('modules.menu.context.edit') }}</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('stock-{{$stock->id}}-delete-form').submit();">{{ trans('modules.menu.context.delete') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
                @include('forms.stock_delete_form', ['id' => $stock->id])
            </div>
            <div class="box-body">
                <div><b>{{ trans('stock::module.view.name') }}:</b> {{$stock->name}}</div>
                <div><b>{{ trans('stock::module.view.slug') }}:</b> {{$stock->slug}}</div>
                <div><b>{{ trans('stock::module.view.desc') }}:</b> {{$stock->description or trans('stock::module.empty')}}</div>
                <div><b>{{ trans('stock::module.view.address') }}:</b> {{$stock->address or trans('stock::module.empty')}}</div>
                <div><b>{{ trans('stock::module.view.subdivision') }}:</b> {{$stock->subdivision->name or trans('stock::module.none')}}</div>
                <div><b>{{ trans('stock::module.view.responsible') }}:</b> {{$stock->user->name or trans('stock::module.none')}}</div>
                <div><b>{{ trans('stock::module.view.date') }}:</b> {{date('d.m.Y H:i', strtotime($stock->created_at))}}</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
