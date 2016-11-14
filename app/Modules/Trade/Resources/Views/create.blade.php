@extends('layouts.main')

@section('title', 'Create trade -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Trade
            <small>Add new</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Trades</a></li>
            <li class="active">Add</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


            <!-- Default box -->
            <div class="box">
                <form action="{{route('trade.store')}}" method="post">
                    {{csrf_field()}}

                    <div class="box-header with-border">
                        <h3 class="box-title">Title</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <a class="btn btn-box-tool" href="{{route('trade')}}">All trades</a>
                        </div>
                    </div>

                    <div class="box-body">

                        <div class="form-group">
                            <label for="trade_status" class="control-label">Status</label>
                            <select id="trade_status" name="status" class="form-control select2">
                                @foreach($all_status as $status)
                                    <option value="{{$status->id}}" title="{{$status->description}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trade_curator" class="control-label">Curator</label>
                            <select id="trade_curator" name="curator" class="form-control select2">
                                <option>Select curator</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trade_client" class="control-label">Client</label>
                            <select id="trade_client" name="client_id" class="form-control select2" required>
                                <option>Select client</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="trade_ppc" class="control-label">Purchase code</label>
                            <select id="trade_ppc" name="ppc" class="form-control select2">
                                <option>Select PPC</option>
                                @foreach($codes as $ppc)
                                    <option value="{{$ppc->id}}" title="{{$ppc->description}}">{{$ppc->code}}: {{str_limit($ppc->description, 80, '...')}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-large btn-primary" type="submit">Create</button>
                    </div>
                <!-- /.box-footer-->
                </form>
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
