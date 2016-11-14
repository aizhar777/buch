@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$client->email or 'Error'}}
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Clients</a></li>
            <li><a href="#">{{$client->email or 'Error'}}</a></li>
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

        <form action="{{route('clients.data.edit',['id' => $client->id])}}" method="post" class="form-horizontal form-label-left">
        {{csrf_field()}}
        {{method_field('PUT')}}


        @if(!empty($client))
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit client form</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('clients',['id' => $client->id])}}">Back</a>
                        <a class="btn btn-box-tool" href="{{route('clients')}}">All clients</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="client_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name"  id="client_name" type="text" class="form-control" placeholder="Client Name" value="{{$client->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_email" class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="email"  id="client_email" type="text" class="form-control" placeholder="Client email" value="{{$client->email}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="phone"  id="client_phone" type="text" class="form-control" placeholder="Client phone" value="{{$client->phone}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_curator" class="control-label col-md-3 col-sm-3 col-xs-12">Client curator</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="client_curator" name="curator" class="form-control">
                                <option value="null">Choose curator</option>
                                @if(!empty($curators))
                                    @foreach($curators as $curator)
                                        <option value="{{$curator->id}}" @if($client->curator == $curator->id) selected @endif >{{$curator->id}}# {{$curator->name}} @if($client->curator == $curator->id) <--current @endif </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- Fields -->
                    @if(!empty($fields))
                        @foreach($fields as $key => $value)
                            @if($value['is_many'])
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$key}}</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" name="fields[{{$key}}]" id="{{$key}}" @if($value['is_required']) required @endif >
                                            <option value="*">Select {{$key}}</option>
                                            @foreach($value['default'] as $k => $v)
                                                <option value="{{$v}}" @if($v == $value['data']) selected="selected" @endif >{{$v}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$value['name']}}</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input class="form-control" type="text" name="fields[{{$key}}]" value="{{$value['data']}}" placeholder="{{$value['name']}}" @if($value['is_required']) required @endif >
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            @endif


        @if(!empty($requisite) && $requisite instanceof \Illuminate\Database\Eloquent\Collection)
            @foreach($requisite as $requisit)
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create requisite form</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="requisite_legal_name" class="control-label col-md-3 col-sm-3 col-xs-12">Legal name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[legal_name]" id="requisite_legal_name" type="text" class="form-control" placeholder="Client legal name" value="{{$requisit->legal_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bank" class="control-label col-md-3 col-sm-3 col-xs-12">Bank</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bank]" id="requisite_bank" type="text" class="form-control" placeholder="Client's bank" value="{{$requisit->bank}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_iik" class="control-label col-md-3 col-sm-3 col-xs-12">IIK</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[iik]" id="requisite_iik" type="text" class="form-control" placeholder="Client's iik" value="{{$requisit->iik}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bin" class="control-label col-md-3 col-sm-3 col-xs-12">BIN</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bin]" id="requisite_bin" type="text" class="form-control" placeholder="Client's bin" value="{{$requisit->bin}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_cbe" class="control-label col-md-3 col-sm-3 col-xs-12">CBE</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[cbe]" id="requisite_cbe" type="text" class="form-control" placeholder="Client's cbe" value="{{$requisit->cbe}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            @endforeach

            @elseif($requisite instanceof \App\Requisite)
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create requisite form</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="requisite_legal_name" class="control-label col-md-3 col-sm-3 col-xs-12">Legal name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[legal_name]" id="requisite_legal_name" type="text" class="form-control" placeholder="Client legal name" value="{{$requisite->legal_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bank" class="control-label col-md-3 col-sm-3 col-xs-12">Bank</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bank]" id="requisite_bank" type="text" class="form-control" placeholder="Client's bank" value="{{$requisite->bank}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_iik" class="control-label col-md-3 col-sm-3 col-xs-12">IIK</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[iik]" id="requisite_iik" type="text" class="form-control" placeholder="Client's iik" value="{{$requisite->iik}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_bin" class="control-label col-md-3 col-sm-3 col-xs-12">BIN</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[bin]" id="requisite_bin" type="text" class="form-control" placeholder="Client's bin" value="{{$requisite->bin}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requisite_cbe" class="control-label col-md-3 col-sm-3 col-xs-12">CBE</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input name="requisite[cbe]" id="requisite_cbe" type="text" class="form-control" placeholder="Client's cbe" value="{{$requisite->cbe}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        Footer
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            @endif
            <div>
                <button class="btn btn-large btn-primary" type="submit">Edit</button>
            </div>
        </form>

    </section>
    <!-- /.content -->
@endsection
