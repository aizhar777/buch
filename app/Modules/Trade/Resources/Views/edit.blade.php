@extends('layouts.main')

@section('title', 'Edit trade #' . $trade->id . ' -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit trade #{{$trade->id}}
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{route('trade')}}">Trades</a></li>
            <li><a href="{{route('trade.show',['id' => $trade->id])}}">Trade #{{$trade->id}}</a></li>
            <li class="active">Edit</li>
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

        <form action="{{route('trade.update', ['id' => $trade->id ])}}" method="post" class="form-horizontal form-label-left">
        {{csrf_field()}}
        {{method_field('PUT')}}
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit trade form</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('trade.show',['id' => $trade->id])}}">Back to Trade</a>
                    <a class="btn btn-box-tool" href="{{route('trade')}}">All trades</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                </div>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="status" class="select2 form-control">
                            @foreach($all_status as $status)
                                <option value="{{$status->id}}" title="{{$status->description}}"
                                        @if($status->id == $trade->status) selected @endif >{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Curator</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="curator" class="select2 form-control">
                            <option>Select curator</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"
                                        @if($user->id == $trade->curator) selected @endif >{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Client</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="client_id" class="select2 form-control" required>
                            <option>Select client</option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}"
                                        @if($client->id == $trade->client_id) selected @endif >{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase code</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="ppc" class="select2 form-control">
                            <option>Select PPC</option>
                            @foreach($codes as $ppc)
                                <option value="{{$ppc->id}}" title="{{$ppc->description}}"
                                        @if($ppc->id == $trade->ppc) selected @endif >{{$ppc->code}}
                                    : {{str_limit($ppc->description, 80, '...')}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-large btn-primary" type="submit">Update</button>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
