@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$client->name or 'Error'}}
            <small>{{$client->email or 'Error'}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('clients') }}">{{trans('clients::module.module_name')}}</a></li>
            <li class="active">{{$client->name or trans('modules.empty')}}</li>
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
                <h3 class="box-title">{{$client->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('clients')}}">
                        {{ trans('clients::module.module_links.all') }}
                    </a>
                    <a class="btn btn-box-tool" href="{{route('clients.edit',['id' => $client->id])}}" title="{{ trans('modules.menu.context.edit') }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-box-tool"
                       onclick="event.preventDefault();document.getElementById('clients-{{$client->id}}-delete-form').submit();"
                       title="{{ trans('modules.menu.context.delete') }}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div><b>{{ trans('clients::module.view.name') }}:</b> {{$client->name}}</div>
                <div><b>{{ trans('clients::module.view.email') }}:</b> {{$client->email}}</div>
                <div><b>{{ trans('clients::module.view.phone') }}:</b> {{$client->phone}}</div>
                <div>
                    <b>{{ trans('clients::module.view.curator') }}:</b>
                    @if($client->supervise)
                        <a href="{{route('user.profile',['id' => $client->supervise->id])}}">{{$client->supervise->name}}</a>
                    @else
                        {{ trans('clients::module.none') }}
                    @endif
                </div>

                @if(!empty($fields))
                    <h4>{{ trans('clients::module.view.addit_inf') }}:</h4>
                    @foreach($fields as $key => $value)
                        @if(is_array($value['data']))
                            <select name="{{$key}}" id="{{$key}}">
                                <option value="">Select {{$key}}</option>
                                @foreach($value['data'] as $k => $v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                        @else
                            <ul>
                                <li><b>{{$value['name']}}:</b> {{$value['data']}}</li>
                            </ul>
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                @if($client->requisites && $client->requisites->count() > 0)
                    <div class="ln_solid"></div>
                    <h4>{{ trans('clients::module.view.requisites') }}</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('clients::module.view.id') }}</th>
                            <th>{{ trans('clients::module.view.legal_name') }}</th>
                            <th>{{ trans('clients::module.view.bank') }}</th>
                            <th>{{ trans('clients::module.view.iik') }}</th>
                            <th>{{ trans('clients::module.view.bin') }}</th>
                            <th>{{ trans('clients::module.view.cbe') }}</th>
                            <th>{{ trans('clients::module.view.date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client->requisites as $requisite)
                            <tr>
                                <th>{{$requisite->id}}</th>
                                <th>{{$requisite->legal_name}}</th>
                                <th>{{$requisite->bank}}</th>
                                <th>{{$requisite->iik}}</th>
                                <th>{{$requisite->bin}}</th>
                                <th>{{$requisite->cbe}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($requisite->created_at))}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">
                        {{ trans('clients::module.messages.req_not_found') }}
                    </div>
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
