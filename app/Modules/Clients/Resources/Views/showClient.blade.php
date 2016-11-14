@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$client->name or 'Error'}}
            <small>{{$client->email or 'Error'}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Clients</a></li>
            <li class="active">{{$client->email or 'Error'}}</li>
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
                <h3 class="box-title">{{$client->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('clients')}}">All clients</a>
                    <a class="btn btn-box-tool" href="{{route('clients.edit',['id' => $client->id])}}">Edit</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('clients-{{$client->id}}-delete-form').submit();">Delete</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                </div>
            </div>
            <div class="box-body">
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
            <!-- /.box-body -->
            <div class="box-footer">

                @if($client->requisites && $client->requisites->count() > 0)
                    <div class="ln_solid"></div>
                    <h4>Client requisite</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Legal name</th>
                            <th>Bank</th>
                            <th>IIK</th>
                            <th>BIN</th>
                            <th>CBE</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client->requisites as $requisite)
                            <tr>
                                <th>{{$requisite->id}}</th>
                                <th>{{$requisite->legal_name}}</th>
                                <th>{{$requisite->bank}}</th>
                                <th>{{$requisite->iik}}</th>
                                <th>{{$requisite->bin}}</th>
                                <th>{{$requisite->cbe}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($requisite->created_at))}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">
                        The client <strong>no requisites!</strong>
                    </div>
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
