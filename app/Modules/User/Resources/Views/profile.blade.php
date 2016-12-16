@extends('layouts.main')

@section('title') {{$user->getFullName()}} @endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{$user->surname or trans('user::module.empty')}} {{$user->name or trans('user::module.empty')}} {{$user->email or trans('user::module.empty')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('user')}}">{{trans('modules.breadcrumbs.users')}}</a></li>
            <li class="active">{{trans('modules.breadcrumbs.profile')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('block.flash_messages')

        @if (count($errors) > 0)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="callout callout-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle cur_pr_img" src="/upload/images/{{ $photo->src or 'user.png'}}" alt="{{trans('user::profile.user_profile_image')}}">

                        <h3 class="profile-username text-center">{{$user->name or trans('modules.empty')}}</h3>

                        <p class="text-muted text-center">{{$user->email or trans('modules.empty')}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="pull-right">1,322</a>
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
                        @if(!empty($fields))
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
                            <hr>
                        @endif

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
                        <li class="active"><a href="#activity" data-toggle="tab">{{trans('user::profile.images')}}</a></li>
                        <li><a href="#info" data-toggle="tab">{{trans('user::profile.info')}}</a></li>
                        <li><a href="#settings" data-toggle="tab">{{trans('user::profile.other')}}</a></li>
                        <li class="dropdown pull-right">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-gear"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{route('user.edit',$user->id)}}">{{trans('modules.menu.context.edit')}}</a>
                                </li>
                                <li>
                                    <a href="#">{{trans('modules.menu.context.delete')}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            @if($user->is_current())
                            <div>
                                <h4>
                                    {{trans('user::profile.gallery')}} <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#add-new-image">{{trans('user::profile.add')}}</button>
                                </h4>

                                <!-- Modal -->
                                <div class="modal fade" id="add-new-image" tabindex="-1" role="dialog" aria-labelledby="addNewImage">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{route('user.upload')}}" method="post" enctype="multipart/form-data" id="upload-images-form">
                                            {{csrf_field()}}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">{{trans('user::profile.uploads_images')}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="file" name="files[]" id="upload_images" multiple="multiple">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <br>
                            @if($images->count() > 0)
                            <!-- =============================================================================== -->
                                <div class="row">
                                    {{--  @each('user::each.profile_images', $user->photos, 'photo') --}}
                                    @foreach($images as $photo)
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="item_image">
                                                <div class="image_wrap">
                                                    <img class="img-responsive" src="/upload/images/{{$photo->src}}" alt="{{trans('user::profile.photo')}} #{{$photo->id}} - {{$user->name}}"/>
                                                </div>
                                                <p>{{trans('user::profile.photo')}} #{{$photo->id}} - {{$user->name}} {{--$photo->name--}}</p>
                                                @if($user->is_current())
                                                <div class="links">
                                                    <a href="{{route('user.update.image',['id' => $user->id, 'image' => $photo->id])}}" title="{{trans('user::profile.set_default_image')}}" data-image-id="{{$photo->id}}" class="set_default_image"><i class="fa fa-user"></i></a>
                                                    <a href="#" title="{{trans('modules.menu.context.delete')}} {{trans('user::profile.photo')}}"><i class="fa fa-trash"></i></a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            <!-- =============================================================================== -->
                            @endif
                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="info">
                            <div class="box box-solid">
                                <!--<div class="box-header with-border">
                                    <h3 class="box-title">Collapsible Accordion</h3>
                                </div>-->
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#subdivision_info">
                                                        {{trans('modules.requisites')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="subdivision_info" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <a href="{{route('user.edit',['id' => $user->id, 'tab' => 'requisite'])}}" class="btn btn-primary">{{trans('user::profile.add_requisite')}}</a>
                                                    <hr>
                                                    @if($user->requisites->count() > 0)
                                                        @foreach($user->requisites as $req)
                                                            <span class="label label-default">{{$req->bank}}</span>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-info">
                                                            <p>{{trans('user::profile.requisites_not_found')}}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        @if($user->oversees->count() > 0)
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#oversees_info">
                                                        {{trans('user::profile.oversees')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="oversees_info" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @foreach($user->oversees as $client)
                                                        <a href="{{route('clients',['id' => $client->id])}}" class="btn btn-default"><i class="fa fa-user"></i> {{$client->name}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if($user->subdivisions->count() > 0)
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#subdivision_info">
                                                        {{trans('modules.subdivision')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="subdivision_info" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @foreach($user->subdivisions as $sub)
                                                        <span class="label label-default">{{$sub->name}}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if($user->stock->count() > 0)
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#stock_info">
                                                        {{trans('modules.stock')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="stock_info" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @foreach($user->stock as $stock)
                                                        <span class="label label-default">{{$stock->name}}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                        @if($user->trades->count() > 0)
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#trades_info">
                                                        {{trans('modules.trades')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="trades_info" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @foreach($user->trades as $trade)
                                                        <a href="{{route('trade.show',['id' => $trade->id])}}" class="btn btn-sm btn-default">{{trans('user::profile.trade_with_client',['name' => $trade->client->name])}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                        @if($user->completedTrades->count() > 0)
                                        <div class="panel box box-default">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#completed_trades_info">
                                                        {{trans('user::profile.completed_trades')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="completed_trades_info" class="panel-collapse collapse">
                                                <div class="box-body">
                                                    @foreach($user->completedTrades as $trade)
                                                        <a href="{{route('trade.show',['id' => $trade->id])}}" class="btn btn-sm btn-default">{{trans('user::profile.trade_with_client',['name' => $trade->client->name])}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
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
