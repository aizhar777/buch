@extends('layouts.main')

@section('title', 'Role ' . $role->name . ' -')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Role {{$role->name or 'Error'}}</h3>
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

                            <h2>{{$role->name}} role</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li>
                                    <a href="{{route('user.roles')}}" title="All trades"><i class="fa fa-th-list"></i></a>
                                </li>
                                <li>
                                    <a href="{{route('user.roles.edit',['id' => $role->id])}}" title="Edit"><i
                                                class="fa fa-pencil-square"></i></a>
                                </li>
                                <li>
                                    <a onclick="event.preventDefault();document.getElementById('roles-{{$role->id}}-delete-form').submit();"
                                       title="Delete"><i class="fa fa-trash"></i></a>
                                </li>
                            </ul>
                            @include('forms.role_perms_delete_form', ['id' => $role->id, 'slug' => 'roles'])

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div><b>ID:</b> {{$role->id}}</div>
                            <div><b>SLUG:</b> {{$role->slug}}</div>
                            <div><b>Name:</b> {{$role->name}}</div>
                            <div><b>Name:</b> {{$role->description}}</div>
                            <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($role->updated_at))}}</div>
                            @if($role->slug != 'visitor')
                                <div>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add permissions for this Role</a>

                                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Text in a modal</h4>
                                                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <h3>Permissions:</h3>
                                @if($checkEditPerm)
                                <form action="{{route('user.roles.update.perms',['id' => $role->id])}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('PUT')}}
                                @endif
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                            <?php
                                                $checked = false;
                                                if(in_array($permission->slug, $rolePerms))
                                                    $checked = true;
                                            ?>
                                            <div class="checkbox col-lg-3 col-md-4 col-sm-12">
                                                <label>
                                                    <input type="checkbox" class="flat" name="permissions[{{$permission->slug}}]" value="{{$permission->id}}" @if($checked) checked @endif @if(!$checkEditPerm) disabled @endif> {{trans("user::permissions.".$permission->name)}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                @if($checkEditPerm)
                                    <button type="submit" class="btn btn-primary">Update</button>

                                </form>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
