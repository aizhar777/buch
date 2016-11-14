@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clients
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
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
                <h3 class="box-title">All clients</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('clients.create')}}">Add client</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                </div>
            </div>
            <div class="box-body">

                @if(!empty($clients) and $clients->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Phone</th>
                            <th>Curator</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <th>{{$client->id}}</th>
                                <th>{{$client->name}}</th>
                                <th>{{$client->email}}</th>
                                <th>{{$client->phone}}</th>
                                <th>
                                    @if($client->supervise)
                                        <a href="{{route('user.profile',['id' => $client->supervise->id])}}">{{$client->supervise->name}}</a>
                                    @else
                                        none
                                    @endif
                                </th>
                                <th>{{date('d.m.Y H:i', strtotime($client->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-small btn-primary btn-round" href="{{route('clients', ['id'=> $client->id])}}"> View</a>
                                        <a class="btn btn-small btn-primary btn-round" href="{{route('clients.edit', ['id'=> $client->id])}}"> Edit</a>
                                        <a class="btn btn-small btn-primary btn-round" onclick="event.preventDefault();document.getElementById('clients-{{$client->id}}-delete-form').submit();"> delete</a>
                                    </div>
                                    @include('forms.clients_delete_form', ['id' => $client->id])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>Clients not found</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($clients->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$clients->appends(['items' => request('items')])->links()}}
                    @else
                        {{$clients->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
