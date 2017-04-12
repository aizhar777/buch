@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('clients::module.module_name')}}
            <small>{{ trans('modules.menu.context.add') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('clients') }}">{{trans('clients::module.module_name')}}</a></li>
            <li class="active">{{ trans('modules.menu.context.create') }}</li>
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

        <form action="{{route('clients.data.create')}}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('clients::module.form.create_form_label') }}</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('clients')}}">{{ trans('clients::module.module_links.all') }}</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="client_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.name') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name"  id="client_name" type="text" class="form-control" placeholder="{{ trans('clients::module.form.name') }}" value="{{old('name')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_email" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.email') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="email"  id="client_email" type="text" class="form-control" placeholder="{{ trans('clients::module.form.email') }}" value="{{old('email')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_phone" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.phone') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="phone"  id="client_phone" type="text" class="form-control" placeholder="{{ trans('clients::module.form.phone') }}" value="{{old('phone')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_curator" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.curator') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="client_curator" name="curator" class="form-control">
                                @if(!empty($curators))
                                    @foreach($curators as $curator)
                                        <option value="{{$curator->id}}" @if(old('curator') == $curator->id) selected @endif >
                                            {{$curator->id}}# {{$curator->name}} ({{$curator->email}})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('clients::module.form.create_requisite_form_label') }}</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="requisite_legal_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.legal_name') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="legal_name" id="requisite_legal_name" type="text" class="form-control" placeholder="{{ trans('clients::module.form.legal_name') }}" value="{{old('legal_name')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="requisite_iin" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.iin') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="iin" id="requisite_iin" type="text" class="form-control" placeholder="{{ trans('clients::module.form.iin') }}" value="{{old('iin')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="requisite_bank" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.bank') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="bank" id="requisite_bank" type="text" class="form-control" placeholder="{{ trans('clients::module.form.bank') }}" value="{{old('bank')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="requisite_iik" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.iik') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="iik" id="requisite_iik" type="text" class="form-control" placeholder="{{ trans('clients::module.form.iik') }}" value="{{old('iik')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="requisite_bin" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.bin') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="bin" id="requisite_bin" type="text" class="form-control" placeholder="{{ trans('clients::module.form.bin') }}" value="{{old('bin')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="requisite_cbe" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('clients::module.form.cbe') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="cbe" id="requisite_cbe" type="text" class="form-control" placeholder="{{ trans('clients::module.form.cbe') }}" value="{{old('cbe')}}">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

                <div>
                    <button class="btn btn-large btn-primary" type="submit">{{ trans('modules.menu.context.create') }}</button>
                </div>
        </form>

    </section>
    <!-- /.content -->
@endsection
