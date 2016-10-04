@extends('layouts.main')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Profile: {{$user->name or 'No name'}} {{$user->email or ''}}</h3>
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
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Data</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                            <a href="#">Add field</a>
                                        </li>
                                        <li>
                                            <a href="{{route('user.edit',$user->id)}}">Edit</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                                <form action="{{route('user.edit.post',$user->id)}}" method="post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label>You'r name</label>
                                        <input type="text" name="name" value="{{$user->name}}" placeholder="Name">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{$user->email}}" placeholder="E-Mail">
                                    </div>

                                    @if(!empty($fields))
                                        @foreach($fields as $key => $value)
                                            @if(is_array($value))
                                                <div class="form-group">
                                                    <label>{{$key}}</label>
                                                    <select name="fields[{{$key}}]" id="{{$key}}">
                                                        <option value="*">Select {{$key}}</option>
                                                        @foreach($value as $k => $v)
                                                            <option value="{{$k}}">{{$v}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label>{{$key}}</label>
                                                    <input type="text" name="fields[{{$key}}]" value="{{$value}}" placeholder="{{$value}}">
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="form-group">
                                        <button class="btn btn-default">Send</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
