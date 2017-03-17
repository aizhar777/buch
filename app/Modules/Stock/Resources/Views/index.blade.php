@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('stock::module.module_links.all')}}
            <small>{{ trans('modules.list') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('stock::module.module_links.all')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('modules.list')}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('stock.create')}}">{{ trans('stock::module.module_links.create') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($stocks) and $stocks->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>{{ trans('stock::module.view.name') }}</th>
                            <th>{{ trans('stock::module.view.slug') }}</th>
                            <th>{{ trans('stock::module.view.desc') }}</th>
                            <th>{{ trans('stock::module.view.subdivision') }}</th>
                            <th>{{ trans('stock::module.view.responsible') }}</th>
                            <th>{{ trans('stock::module.view.address') }}</th>
                            <th>{{ trans('stock::module.view.date') }}</th>
                            <th>{{ trans('stock::module.view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <th>{{$stock->id}}</th>
                                <th>{{$stock->name}}</th>
                                <th>{{$stock->slug}}</th>
                                <th>{{$stock->description or 'Empty'}}</th>
                                <th>{{$stock->subdivision->name or $stock->subdivision_id}}</th>
                                <th>
                                    @if(!is_null($stock->responsible))
                                        <a href="{{ route('user.profile',['id' => $stock->user->id]) }}">{{$stock->user->name or trans('stock::module.none')}}</a>
                                    @else
                                        {{ trans('stock::module.none') }}
                                    @endif
                                </th>
                                <th>{{$stock->address or trans('stock::module.empty')}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($stock->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-primary" href="{{route('stock.show', ['id'=> $stock->id])}}"> {{ trans('modules.menu.view.view') }}</a>
                                        <a class="btn btn-sm btn-primary" href="{{route('stock.edit', ['id'=> $stock->id])}}"> {{ trans('modules.menu.context.edit') }}</a>
                                        <a class="btn btn-sm btn-primary" onclick="event.preventDefault();document.getElementById('stock-{{$stock->id}}-delete-form').submit();"> {{ trans('modules.menu.context.delete') }}</a>
                                    </div>
                                    @include('forms.stock_delete_form', ['id' => $stock->id])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>{{ trans('stock::module.messages.stock_not_found') }}</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($stocks->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$stocks->appends(['items' => request('items')])->links()}}
                    @else
                        {{$stocks->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
