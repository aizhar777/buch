@extends('layouts.main')

@section('title', 'Create Role -')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Add new role</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

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

                <div class="col-md-12 col-sm-12 col-xs-12">

                    @include('block.flash_messages')


                    <form action="{{route('user.roles.store')}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}

                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Create role form</h2>

                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">

                                        <a href="#"
                                           class="dropdown-toggle"
                                           data-toggle="dropdown"
                                           role="button"
                                           aria-expanded="false">
                                            <i class="fa fa-wrench"></i>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{route('user.roles')}}">All stores</a>
                                            </li>
                                        </ul>

                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <div class="form-group">
                                    <label for="role_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name role</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="name"  id="role_name" type="text" class="form-control" placeholder="Role name" value="{{old('name')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role_slug" class="control-label col-md-3 col-sm-3 col-xs-12">Slug role</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="slug"  id="role_slug" type="text" class="form-control" placeholder="Slug name" value="{{old('slug')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role_desc" class="control-label col-md-3 col-sm-3 col-xs-12">Description role</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea class="form-control" name="description" id="role_desc" rows="5" placeholder="Role decription">{{old('description')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role_special" class="control-label col-md-3 col-sm-3 col-xs-12">Admin role</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <label for="role_special" style="font-weight: normal;"><input type="checkbox" id="role_special" name="special"> has administrator role</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <button class="btn btn-large btn-primary" type="submit">Create</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
