@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{$client->name or 'Error'}} < {{$client->email or 'Error'}} ></h3>
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

                                <h2>Client: {{$client->name or 'Error'}}</h2>

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
                                                <a href="{{route('clients')}}">All clients</a>
                                            </li>
                                            <li>
                                                <a href="{{route('clients.edit',['id' => $client->id])}}">Edit</a>
                                            </li>
                                            <li>
                                                <a onclick="event.preventDefault();document.getElementById('clients-{{$client->id}}-delete-form').submit();">Delete</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                @include('forms.clients_delete_form', ['id' => $client->id])

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <h4>Client data:</h4>
                                <div><b>Name:</b> {{$client->name}}</div>
                                <div><b>E-Mail:</b> {{$client->email}}</div>
                                <div><b>Phone:</b> {{$client->phone}}</div>
                                <div>
                                    <b>Curator:</b>
                                    @if($client->supervise)
                                        <a href="{{route('user.profile',['id' => $client->supervise->id])}}">{{$client->supervise->name}}</a>
                                    @else
                                        none
                                    @endif
                                </div>

                                @if(!empty($fields))
                                    <h4>Additional Information:</h4>
                                    @foreach($fields as $key => $value)
                                        @if(is_array($value['data']))
                                            <select name="{{$key}}" id="{{$key}}">
                                                <option value="">Select {{$key}}</option>
                                                @foreach($value['data'] as $k => $v)
                                                    <option value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <ul>
                                                <li><b>{{$value['name']}}:</b> {{$value['data']}}</li>
                                            </ul>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
