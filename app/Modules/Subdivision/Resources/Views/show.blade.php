@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $subdivision->name or 'Error' }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('subdivision') }}">{{trans('subdivision::module.module_links.all')}}</a></li>
            <li class="active">{{ $subdivision->name or 'Error' }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('block.flash_messages')

        @if (count($errors) > 0)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$subdivision->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('subdivision')}}">{{ trans('subdivision::module.module_links.all') }}</a>
                    <a class="btn btn-box-tool" href="{{route('subdivision.edit',['id' => $subdivision->id])}}">{{ trans('modules.menu.context.edit') }}</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('subdivision-{{$subdivision->id}}-delete-form').submit();">{{ trans('modules.menu.context.delete') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                @include('forms.delete_form', ['id' => $subdivision->id, 'slug' => 'subdivision'])
            </div>
            <div class="box-body">
                <div><b>{{ trans('subdivision::module.view.name') }}:</b> {{$subdivision->name}}</div>
                <div><b>{{ trans('subdivision::module.view.slug') }}:</b> {{$subdivision->slug}}</div>
                <div><b>{{ trans('subdivision::module.view.desc') }}:</b> {{$subdivision->description or 'Empty'}}</div>
                <div><b>{{ trans('subdivision::module.view.address') }}:</b> {{$subdivision->address or 'None'}}</div>
                <div><b>{{ trans('subdivision::module.view.responsible') }}:</b> <a href="{{ route('user.profile',['id' => $subdivision->user->id]) }}">{{$subdivision->user->name or 'None'}}</a></div>
                <div><b>{{ trans('subdivision::module.view.date') }}:</b> {{date('d.m.Y H:i', strtotime($subdivision->created_at))}}</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
