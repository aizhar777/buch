@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$client->name or 'Error'}}
            <small>{{ trans('modules.menu.context.edit') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('clients') }}">{{trans('clients::module.module_name')}}</a></li>
            <li><a href="{{ route('clients',['id' => $client->id]) }}">{{$client->name or trans('clients::module.empty')}}</a></li>
            <li class="active">{{ trans('modules.menu.context.edit') }}</li>
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

        <form action="{{route('clients.data.edit',['id' => $client->id])}}" method="post" class="form-horizontal form-label-left">
        {{csrf_field()}}
        {{method_field('PUT')}}


        @if(!empty($client))
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('clients::module.form.edit_form_label') }}</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('clients',['id' => $client->id])}}">{{ trans('modules.menu.context.back') }}</a>
                        <a class="btn btn-box-tool" href="{{route('clients')}}">{{trans('clients::module.module_links.all')}}</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="client_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.name') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name"  id="client_name" type="text" class="form-control" placeholder="{{ trans('clients::module.form.name') }}" value="{{$client->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_email" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.email') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="email"  id="client_email" type="text" class="form-control" placeholder="{{ trans('clients::module.form.email') }}" value="{{$client->email}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_phone" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.phone') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="phone"  id="client_phone" type="text" class="form-control" placeholder="{{ trans('clients::module.form.phone') }}" value="{{$client->phone}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_curator" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.curator') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="client_curator" name="curator" class="form-control">
                                @if(!empty($curators))
                                    @foreach($curators as $curator)
                                        <option value="{{$curator->id}}" @if($client->curator == $curator->id) selected @endif >{{$curator->id}}# {{$curator->name}} @if($client->curator == $curator->id) <--current @endif </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- Fields -->
                    @if(!empty($fields))
                        @foreach($fields as $key => $value)
                            @if($value['is_many'])
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$key}}</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" name="fields[{{$key}}]" id="{{$key}}" @if($value['is_required']) required @endif >
                                            <option value="*">Select {{$key}}</option>
                                            @foreach($value['default'] as $k => $v)
                                                <option value="{{$v}}" @if($v == $value['data']) selected="selected" @endif >{{$v}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$value['name']}}</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input class="form-control" type="text" name="fields[{{$key}}]" value="{{$value['data']}}" placeholder="{{$value['name']}}" @if($value['is_required']) required @endif >
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            @endif


        @if(!empty($requisite) && $requisite instanceof \Illuminate\Database\Eloquent\Collection)
            @foreach($requisite as $requisit)
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('clients::module.form.edit_requisite_form_label') }}</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="requisite_legal_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.legal_name') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[legal_name]" id="requisite_legal_name" type="text" class="form-control" placeholder="{{ trans('clients::module.form.legal_name') }}" value="{{$requisit->legal_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bank" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.bank') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bank]" id="requisite_bank" type="text" class="form-control" placeholder="{{ trans('clients::module.form.bank') }}" value="{{$requisit->bank}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_iik" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.iik') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[iik]" id="requisite_iik" type="text" class="form-control" placeholder="{{ trans('clients::module.form.iik') }}" value="{{$requisit->iik}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bin" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.bin') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bin]" id="requisite_bin" type="text" class="form-control" placeholder="{{ trans('clients::module.form.bin') }}" value="{{$requisit->bin}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_cbe" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.cbe') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[cbe]" id="requisite_cbe" type="text" class="form-control" placeholder="{{ trans('clients::module.form.cbe') }}" value="{{$requisit->cbe}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            @endforeach

            @elseif($requisite instanceof \App\Requisite)
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('clients::module.form.edit_requisite_form_label') }}</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="requisite_legal_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.legal_name') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[legal_name]" id="requisite_legal_name" type="text" class="form-control" placeholder="{{ trans('clients::module.form.legal_name') }}" value="{{$requisite->legal_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bank" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.bank') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bank]" id="requisite_bank" type="text" class="form-control" placeholder="{{ trans('clients::module.form.bank') }}" value="{{$requisite->bank}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_iik" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.iik') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[iik]" id="requisite_iik" type="text" class="form-control" placeholder="{{ trans('clients::module.form.iik') }}" value="{{$requisite->iik}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bin" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.bin') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bin]" id="requisite_bin" type="text" class="form-control" placeholder="{{ trans('clients::module.form.bin') }}" value="{{$requisite->bin}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_cbe" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.cbe') }}</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[cbe]" id="requisite_cbe" type="text" class="form-control" placeholder="{{ trans('clients::module.form.cbe') }}" value="{{$requisite->cbe}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            @endif
            <div>
                <button class="btn btn-large btn-primary" type="submit">{{ trans('modules.menu.context.update') }}</button>
            </div>
        </form>

    </section>
    <!-- /.content -->
@endsection
