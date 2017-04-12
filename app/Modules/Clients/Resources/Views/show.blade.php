@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('clients::module.module_name') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('clients::module.module_name')}}</li>
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
                <h3 class="box-title">{{ trans('clients::module.module_links.all') }}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('clients.create')}}">{{ trans('clients::module.module_links.create') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($clients) and $clients->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('clients::module.view.id') }}</th>
                            <th>{{ trans('clients::module.view.name') }}</th>
                            <th>{{ trans('clients::module.view.email') }}</th>
                            <th>{{ trans('clients::module.view.phone') }}</th>
                            <th>{{ trans('clients::module.view.curator') }}</th>
                            <th>{{ trans('clients::module.view.date') }}</th>
                            <th>{{ trans('clients::module.view.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <th>{{$client->id}}</th>
                                <th>{{$client->name}}</th>
                                <th>{{$client->email}}</th>
                                <th>{{$client->phone}}</th>
                                <th>
                                    @if($client->supervise)
                                        <a href="{{route('user.profile',['id' => $client->supervise->id])}}">{{$client->supervise->name}}</a>
                                    @else
                                        {{ trans('clients::module.none') }}
                                    @endif
                                </th>
                                <th>{{date('d.m.Y H:i', strtotime($client->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-small btn-default btn-round" title="{{ trans('modules.menu.view.view') }}" href="{{route('clients', ['id'=> $client->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a class="btn btn-small btn-default btn-round" title="{{ trans('modules.menu.context.edit') }}" href="{{route('clients.edit', ['id'=> $client->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a class="btn btn-small btn-danger btn-round"  title="{{ trans('modules.menu.context.delete') }}" onclick="event.preventDefault();document.getElementById('clients-{{$client->id}}-delete-form').submit();"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    @include('forms.clients_delete_form', ['id' => $client->id])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>{{ trans('clients::module.messages.not_found') }}</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($clients->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$clients->appends(['items' => request('items')])->links()}}
                    @else
                        {{$clients->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
