@extends('layouts.main')

@section('title') {{trans('modules.menu.context.edit')}} {{$user->name or trans('modules.empty')}} @endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$user->name or trans('modules.empty')}}
            <small>{{$user->email or trans('modules.empty')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('user')}}">{{trans('modules.breadcrumbs.users')}}</a></li>
            <li><a href="{{route('user.profile',['id' => $user->id])}}">{{$user->name or trans('modules.empty')}}</a></li>
            <li class="active">{{trans('modules.menu.context.edit')}}</li>
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


    <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
                <li>
                    <a href="#tab_2" data-toggle="tab">{{trans('user::profile.password')}}</a>
                </li>
                <li class="active">
                    <a href="#tab_1" data-toggle="tab">{{trans('user::profile.profile')}}</a>
                </li>
                <li class="pull-left header"><i class="fa fa-user"></i> {{trans('modules.menu.context.update')}} {{$user->name or trans('modules.empty')}}</li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <form action="{{route('user.edit.post',$user->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>{{trans('user::form.you_name')}}</label>
                            <input class="form-control" type="text" name="name" value="{{$user->name}}" placeholder="{{trans('user::form.name')}}">
                        </div>

                        <div class="form-group">
                            <label>{{trans('user::form.you_email')}}</label>
                            <input class="form-control" type="text" name="email" value="{{$user->email}}" placeholder="{{trans('user::form.email')}}">
                        </div>

                        @if(!empty($fields))
                            @foreach($fields as $key => $value)
                                @if($value['is_many'])
                                    @if(!$value['is_hidden'])
                                        <div class="form-group">
                                            <label>{{$key}}</label>
                                            <select class="form-control" name="fields[{{$key}}]" id="{{$key}}" @if($value['is_required']) required @endif >
                                                <option value="*">Select {{$key}}</option>
                                                @foreach($value['default'] as $k => $v)
                                                    <option value="{{$v}}" @if($v == $value['data']) selected="selected" @endif >{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @else
                                    @if(!$value['is_hidden'])
                                        <div class="form-group">
                                            <label>{{$value['name']}}</label>
                                            <input class="form-control" type="text" name="fields[{{$key}}]" value="{{$value['data']}}" placeholder="{{$value['name']}}" @if($value['is_required']) required @endif >
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        <div class="form-group">
                            <button class="btn btn-default">{{trans('modules.menu.context.update')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->

    </section>
    <!-- /.content -->

@endsection
