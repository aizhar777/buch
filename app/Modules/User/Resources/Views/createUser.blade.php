@extends('layouts.main')

@section('title', trans('modules.breadcrumbs.users') . ' -')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('user::module.create_user')}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
        <li><a href="{{route('user')}}"><i class="fa fa-users"></i> {{trans('modules.breadcrumbs.users')}}</a></li>
        <li class="active">{{trans('user::module.create_user')}}</li>
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
            <h3 class="box-title">{{ trans('user::module.user') }}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
            </div>
        </div>
        <form action="{{ route('user.store') }}" method="post">
            <div class="box-body">
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label for="input_name">{{ trans('user::form.name') }}</label>
                      <input name="name" type="text" class="form-control" id="input_name" placeholder="{{ trans('user::form.name') }}">
                    </div>

                    <div class="form-group">
                      <label for="input_surname">{{ trans('user::form.surname') }}</label>
                      <input name="surname" type="text" class="form-control" id="input_surname" placeholder="{{ trans('user::form.surname') }}">
                    </div>

                    <div class="form-group">
                      <label for="input_patronymic">{{ trans('user::form.patronymic') }}</label>
                      <input name="patronymic" type="text" class="form-control" id="input_patronymic" placeholder="{{ trans('user::form.patronymic') }}">
                    </div>

                    <div class="form-group">
                      <label for="input_email">{{ trans('user::form.email') }}</label>
                      <input name="email" type="email" class="form-control" id="input_email" placeholder="{{ trans('user::form.email') }}">
                    </div>

                    <div class="form-group">
                      <label for="input_password">{{ trans('user::form.password') }}</label>
                      <input name="password" type="password" class="form-control" id="input_password" placeholder="{{ trans('user::form.password') }}">
                    </div>

                    <div class="form-group">
                      <label for="input_confirm_password">{{ trans('user::form.confirm_password') }}</label>
                      <input name="password_confirmation" type="password" class="form-control" id="input_confirm_password" placeholder="{{ trans('user::form.confirm_password') }}">
                    </div>

                    @if (isset($roles) && $roles->count() > 0)
                        <div class="form-group">
                          <label for="input_role">{{ trans('user::form.create_with_role') }}</label>
                          <select id="input_role" class="select2_multiple form-control" name="roles[]" multiple>
                              <option value="*">{{ trans('user::form.change') }}</option>
                              @foreach ($roles as $role)
                                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                              @endforeach
                          </select>
                        </div>
                    @endif

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-success">{{ trans('modules.menu.context.create') }}</button>
            </div>
            <!-- /.box-footer-->
        </form>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection
