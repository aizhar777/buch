@extends('layouts.main')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{$user->name or 'No name'}} {{$user->email or ''}}
            <small>
                @role('admin')
                Administrtor
                @else
                    Profile
                    @endrole
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('block.flash_messages')

        @if (count($errors) > 0)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="callout callout-danger">
                    <p>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle cur_pr_img" src="/upload/images/{{ $photo->src or 'user.png'}}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{$user->name or 'No name'}}</h3>

                        <p class="text-muted text-center">{{$user->email or 'No name'}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                        <p>

                            <select name="user_role" class="select2_multiple form-control" multiple>
                                @foreach($allRoles as $aRl)
                                    <option value="{{$aRl->id}}" @if(in_array($aRl->id, $userRoles)) selected @endif >{{$aRl->name}}</option>
                                @endforeach
                                <option value="AK">Alaska</option>
                            </select>
                        </p>
                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        @if(!empty($fields))
                            <hr>
                            <strong><i class="fa fa-pencil margin-r-5"></i> Fields</strong>
                            <p>
                                @foreach($fields as $key => $value)
                                    @if(is_array($value['data']))
                                        @if(!$value['is_hidden'])
                                            <p>{{$value['name']}}:</p>
                                            @foreach($value['data'] as $v) {{$v}} @endforeach
                                        @endif
                                    @else
                                        @if(!$value['is_hidden'])
                                            <p>{{$value['name']}}</p> {{$value['data']}}
                                        @endif
                                    @endif
                                @endforeach
                            </p>
                        @endif
                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Roles</strong>

                        <p>
                            @foreach($userRolesArray as $rlLabel) <span class="label label-info">{{$rlLabel}}</span> @endforeach
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Images</a></li>
                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li><a href="#settings" data-toggle="tab">Settings</a></li>
                        <li class="dropdown pull-right">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-gear"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{route('user.edit',$user->id)}}">Edit</a>
                                </li>
                                <li>
                                    <a href="#">Delete</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div>
                                Media gallery emelents <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#add-new-image">Add new photo</button>
                                <!-- Modal -->
                                <div class="modal fade" id="add-new-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{route('user.upload')}}" method="post" enctype="multipart/form-data" id="upload-images-form">
                                            {{csrf_field()}}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="file" name="files[]" id="upload_images" multiple="multiple">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @if($user->photos->count() > 0)

                            <!-- =============================================================================== -->
                                <div class="row">
                                    {{--  @each('user::each.profile_images', $user->photos, 'photo') --}}
                                    @foreach($user->photos as $photo)
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="item_image">
                                                <div class="image_wrap">
                                                    <img class="img-responsive" src="/upload/images/{{$photo->src}}" alt="Photo #{{$photo->id}} - {{$user->name}}"/>
                                                </div>
                                                <p>{{$photo->name}}</p>
                                                <div class="links">
                                                    <a href="{{route('user.update.image',['id' => $user->id, 'image' => $photo->id])}}" title="Set as default" data-image-id="{{$photo->id}}" class="set_default_image"><i class="fa fa-user"></i></a>
                                                    <a href="#" title="Set as default"><i class="fa fa-cog"></i></a>
                                                </div>
                                            </div>
                                           {{-- <div class="profile_gal_image">
                                                <p>{{$photo->name}}</p>
                                                <div class="links">
                                                    <a href="{{route('user.update.image',['id' => $user->id, 'image' => $photo->id])}}" title="Set as default" data-image-id="{{$photo->id}}" class="set_default_image"><i class="fa fa-user"></i></a>
                                                    <a href="#" title="Set as default"><i class="fa fa-cog"></i></a>
                                                </div>
                                            </div>--}}
                                        </div>
                                    @endforeach
                                </div>
                            <!-- =============================================================================== -->
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            timeline
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            settings
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
