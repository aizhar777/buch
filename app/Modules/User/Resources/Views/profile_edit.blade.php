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

    <div>
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
    </div>

    <!-- Main content -->
    <section class="content">
    <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
                <li class="@if(request('tab') == 'requisite') active @endif">
                    <a href="#tab_requisite" data-toggle="tab">{{trans('user::profile.requisite')}}</a>
                </li>
                <li class="@if(request('tab') == 'password') active @endif">
                    <a href="#tab_update_password" data-toggle="tab">{{trans('user::profile.password')}}</a>
                </li>
                <li class="@if(request('tab') == 'profile' || request('tab') == null) active @endif">
                    <a href="#tab_1" data-toggle="tab">{{trans('user::profile.profile')}}</a>
                </li>
                <li class="pull-left header"><i class="fa fa-user"></i> {{trans('modules.menu.context.update')}} {{$user->name or trans('modules.empty')}}</li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if(request('tab') == 'profile' || request('tab') == null) active @endif " id="tab_1">
                    <form action="{{route('user.edit.post',$user->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>{{trans('user::form.you_name')}}</label>
                            <input class="form-control" type="text" name="name" value="{{$user->name}}" placeholder="{{trans('user::form.name')}}">
                        </div>

                        <div class="form-group">
                            <label>{{trans('user::form.you_surname')}}</label>
                            <input class="form-control" type="text" name="surname" value="{{$user->surname}}" placeholder="{{trans('user::form.surname')}}">
                        </div>

                        <div class="form-group">
                            <label>{{trans('user::form.you_patronymic')}}</label>
                            <input class="form-control" type="text" name="patronymic" value="{{$user->patronymic}}" placeholder="{{trans('user::form.patronymic')}}">
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
                <div class="tab-pane @if(request('tab') == 'password') active @endif " id="tab_update_password">
                    <form action="{{ route('user.update.pass', ['id' => $user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                          <label for="current_password">{{ trans('user::form.current_password') }}</label>
                          <input name="current_password" type="password" class="form-control" id="current_password" placeholder="">
                        </div>

                        <div class="form-group">
                          <label for="password">{{ trans('user::form.password') }}</label>
                          <input name="password" type="password" class="form-control" id="password" placeholder="">
                        </div>

                        <div class="form-group">
                          <label for="confirm_password">{{ trans('user::form.confirm_password') }}</label>
                          <input name="password_confirmation" type="password" class="form-control" id="confirm_password" placeholder="">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{trans('modules.menu.context.update')}}</button>
                        </div>

                    </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane @if(request('tab') == 'requisite') active @endif " id="tab_requisite">
                    <h3>{{trans('user::profile.add_requisite')}}</h3>
                    <form action="{{route('user.create.requisite',['id' => $user->id])}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="requisite_legal_name">{{ trans('user::form.requisite.legal_name') }}</label>
                            <input name="legal_name" value="{{old('legal_name')}}" type="text" class="form-control" id="requisite_legal_name" placeholder="{{ trans('user::form.requisite.legal_name') }}">
                        </div>


                        <div class="form-group">
                            <label for="requisite_iin">{{ trans('user::form.requisite.iin') }}</label>
                            <input name="iin" value="{{old('iin')}}" type="text" class="form-control" id="requisite_iin" placeholder="{{ trans('user::form.requisite.iin') }}">
                        </div>


                        <div class="form-group">
                            <label for="requisite_bank">{{ trans('user::form.requisite.bank') }}</label>
                            <input name="bank" value="{{old('bank')}}" type="text" class="form-control" id="requisite_bank" placeholder="{{ trans('user::form.requisite.bank') }}">
                        </div>


                        <div class="form-group">
                            <label for="requisite_bin">{{ trans('user::form.requisite.bin') }}</label>
                            <input name="bin" value="{{old('bin')}}" type="text" class="form-control" id="requisite_bin" placeholder="{{ trans('user::form.requisite.bin') }}">
                        </div>


                        <div class="form-group">
                            <label for="requisite_iik">{{ trans('user::form.requisite.iik') }}</label>
                            <input name="iik" value="{{old('iik')}}" type="text" class="form-control" id="requisite_iik" placeholder="{{ trans('user::form.requisite.iik') }}">
                        </div>


                        <div class="form-group">
                            <label for="requisite_cbe">{{ trans('user::form.requisite.cbe') }}</label>
                            <input name="cbe" value="{{old('cbe')}}" type="text" class="form-control" id="requisite_cbe" placeholder="{{ trans('user::form.requisite.cbe') }}">
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{trans('modules.menu.context.create')}}</button>
                        </div>

                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->

    </section>
    <!-- /.content -->

@endsection
