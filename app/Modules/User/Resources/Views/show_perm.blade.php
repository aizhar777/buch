@extends('layouts.main')

@section('title', 'Permission ' . $perm->name . ' -')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Permission {{trans("user::permissions.".$perm->name)}}</h3>
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

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Permission {{trans("user::permissions.".$perm->name)}}</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li>
                                    <a href="{{route('user.perms')}}" title="All trades"><i class="fa fa-th-list"></i></a>
                                </li>
                                <li>
                                    <a href="{{route('user.perms.edit',['id' => $perm->id])}}" title="Edit"><i
                                                class="fa fa-pencil-square"></i></a>
                                </li>
                                <li>
                                    <a onclick="event.preventDefault();document.getElementById('perms-{{$perm->id}}-delete-form').submit();"
                                       title="Delete"><i class="fa fa-trash"></i></a>
                                </li>
                            </ul>
                            @include('forms.role_perms_delete_form', ['id' => $perm->id, 'slug' => 'perms'])

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div><b>ID:</b> {{$perm->id}}</div>
                            <div><b>SLUG:</b> {{$perm->slug}}</div>
                            <div><b>Name:</b> {{trans("user::permissions.".$perm->name)}}</div>
                            <div><b>Name:</b> {{$perm->description}}</div>
                            <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($perm->updated_at))}}</div>
                            <div>
                                <h3>Available for roles:</h3>
                                @foreach($perm->roles as $role)
                                    <a href="{{route('user.roles.show_slug',['slug' => $role->slug ])}}" class="btn btn-small btn-success">{{$role->name}} </a>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
