@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$subdivision->name or 'subdivision'}}
            <small>{{ trans('modules.menu.context.edit') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{ route('subdivision') }}">{{trans('subdivision::module.module_links.all')}}</a></li>
            <li><a href="{{ route('subdivision.show',['id' => $subdivision->id]) }}">{{$subdivision->name or 'subdivision'}}</a></li>
            <li class="active">{{ trans('modules.menu.context.edit') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('block.flash_messages')


    <form action="{{route('subdivision.update',['id' => $subdivision])}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('subdivision.show',['id' => $subdivision->id])}}">{{ trans('subdivision::module.view.go_back') }}</a>
                    <a class="btn btn-box-tool" href="{{route('subdivision')}}">{{ trans('subdivision::module.module_links.all') }}</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label for="subdivision_name" class="control-label">{{ trans('subdivision::module.form.name') }}</label>
                    <input name="name"  id="subdivision_name" type="text" class="form-control" placeholder="{{ trans('subdivision::module.form.name') }}" value="{{$subdivision->name}}">
                </div>

                <div class="form-group">
                    <label for="subdivision_slug" class="control-label">Slug subdivision</label>
                    <input name="slug"  id="subdivision_slug" type="text" class="form-control" placeholder="{{ trans('subdivision::module.form.slug') }}" value="{{$subdivision->slug}}">
                    <span id="helpBlock" class="help-block">{{ trans('subdivision::module.form.only_latin_and_dashes') }}</span>
                </div>

                <div class="form-group">
                    <label for="subdivision_description" class="control-label">{{ trans('subdivision::module.form.desc') }}</label>
                    <textarea name="description" id="subdivision_description" rows="5" class="form-control" placeholder="{{ trans('subdivision::module.form.desc') }}">{{$subdivision->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="subdivision_address" class="control-label">{{ trans('subdivision::module.form.address') }}</label>
                    <input name="address" id="subdivision_address" type="text" class="form-control" placeholder="{{ trans('subdivision::module.form.address') }}" value="{{$subdivision->address}}">
                </div>

                <div class="form-group">
                    <label for="is_responsible_subdivision" class="control-label">{{ trans('subdivision::module.form.add_responsible_checkbox') }}</label>
                    <input name="is_responsible" data-edit="true"  id="is_responsible_subdivision" type="checkbox" @if(!empty(old('is_responsible'))) checked @endif >
                </div>

                <div class="form-group" id="subdivision_responsible_wrap">
                    <label for="subdivision_responsible" class="control-label">&nbsp;</label>
                    <select id="subdivision_responsible" name="responsible" class="form-control">
                        <option value="">{{ trans('subdivision::module.form.responsible') }}</option>
                        @if(!empty($responsibles))
                            @foreach($responsibles as $user)
                                <option value="{{$user->id}}" @if($subdivision->responsible == $user->id) selected @endif >{{$user->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-large btn-primary" type="submit">{{ trans('modules.menu.context.update') }}</button>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </form>

    </section>
    <!-- /.content -->
@endsection
