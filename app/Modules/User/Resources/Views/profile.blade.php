@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">

                <div class="title_left">
                    @role('admin')
                        <h3>Administrtor: {{$user->name or 'No name'}} {{$user->email or ''}}</h3>
                    @else
                        <h3>Profile: {{$user->name or 'No name'}} {{$user->email or ''}}</h3>
                    @endrole
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

                @include('block.flash_messages')

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Data</h2>
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
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{route('user.edit',$user->id)}}">Edit</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- =============================================================================== -->



                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="/upload/images/{{ $photo->src or 'user.png'}}" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                                <h3>{{$user->name or 'No name'}}</h3>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                                    </li>

                                    <li>
                                        <i class="fa fa-email user-profile-icon"></i> {{$user->email or 'No Email'}}
                                    </li>


                                @if(!empty($fields))
                                    @foreach($fields as $key => $value)
                                        @if(is_array($value['data']))
                                            @if(!$value['is_hidden'])
                                                <li>
                                                    <p>{{$value['name']}}:</p>
                                                    @foreach($value['data'] as $v) {{$v}} @endforeach
                                                </li>
                                            @endif
                                        @else
                                            @if(!$value['is_hidden'])
                                                <li>
                                                    <p>{{$value['name']}}</p>
                                                    {{$value['data']}}
                                                </li>
                                            @endif
                                        @endif
                                        @endforeach
                                    @endif

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"></i>
                                        <a href="#" target="_blank">www.site.com</a>
                                    </li>
                                </ul>

                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                                <br />
                                <!-- end of skills -->
                            </div>

                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="profile_title">
                                    <div class="col-md-6">
                                        <h2>User Activity Report</h2>
                                    </div>
                                    <div class="col-md-6">
                                        Other data
                                    </div>
                                </div>

                                Other
                            </div>


                            <!-- =============================================================================== -->
                        </div>
                    </div>

                    @if($user->photos->count() > 0)
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Photo's <small>Media Gallery</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- =============================================================================== -->
                            <p>Media gallery emelents</p>

                            <div class="row">
                                @foreach($user->photos as $photo)
                                <div class="col-md-55">
                                    <div class="thumbnail user_profile">
                                        <div class="image view user_profile view-first">
                                            <img style="width: 100%; display: block;" src="/upload/images/{{$photo->src}}" alt="Photo #{{$photo->id}} - {{$user->name}}" />
                                            <div class="mask">
                                                <p>{{$photo->name}}</p>
                                                <div class="tools tools-bottom">
                                                    <a href="#" title="Set as default"><i class="fa fa-user"></i></a>
                                                    <a href="#" title="Delete this photo"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- =============================================================================== -->
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
