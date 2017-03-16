@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('subdivision::module.module_links.all') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('subdivision::module.module_links.all')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('modules.list') }}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{ route('subdivision.create') }}">{{ trans('subdivision::module.module_links.create') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($subdivisions) and $subdivisions->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>{{ trans('subdivision::module.view.name') }}</th>
                            <th>{{ trans('subdivision::module.view.slug') }}</th>
                            <th>{{ trans('subdivision::module.view.desc') }}</th>
                            <th>{{ trans('subdivision::module.view.responsible') }}</th>
                            <th>{{ trans('subdivision::module.view.address') }}</th>
                            <th>{{ trans('subdivision::module.view.date') }}</th>
                            <th>{{ trans('subdivision::module.view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subdivisions as $sub)
                            <tr>
                                <th>{{$sub->id}}</th>
                                <th>{{$sub->name}}</th>
                                <th>{{$sub->slug}}</th>
                                <th>{{$sub->description or 'Empty'}}</th>
                                <th>
                                    @if(!is_null($sub->responsible))
                                        <a href="{{ route('user.profile',['id' => $sub->user->id]) }}">{{$sub->user->name or 'None'}}</a>
                                    @else
                                        {{ trans('subdivision::module.none') }}
                                    @endif
                                </th>
                                <th>{{$sub->address or 'Empty'}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($sub->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-small btn-primary" href="{{route('subdivision.show', ['id'=> $sub->id])}}"> {{ trans('modules.menu.view.view') }}</a>
                                        <a class="btn btn-small btn-primary" href="{{route('subdivision.edit', ['id'=> $sub->id])}}"> {{ trans('modules.menu.context.edit') }}</a>
                                        <a class="btn btn-small btn-primary" onclick="event.preventDefault();document.getElementById('subdivision-{{$sub->id}}-delete-form').submit();"> {{ trans('modules.menu.context.delete') }}</a>
                                    </div>
                                    @include('forms.delete_form', ['id' => $sub->id, 'slug' => 'subdivision'])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info">
                        <h4>{{ trans('subdivision::module.messages.subdivision_not_found') }}</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($subdivisions->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$subdivisions->appends(['items' => request('items')])->links()}}
                    @else
                        {{$subdivisions->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
