@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit client: {{$client->email or 'Error'}}</h3>
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


                    <form action="{{route('clients.data.edit',['id' => $client->id])}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        @if(!empty($client))
                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Edit client form</h2>

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
                                                <a href="{{route('clients',['id' => $client->id])}}">Back</a>
                                            </li>
                                            <li>
                                                <a href="{{route('clients')}}">All clients</a>
                                            </li>
                                        </ul>

                                    </li>

                                    <li>
                                        <a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

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
                        </div>
                        @endif

                        @if(!empty($requisite) && $requisite instanceof \Illuminate\Database\Eloquent\Collection)
                            @foreach($requisite as $requisit)
                                <div class="x_panel">
                            <div class="x_title">

                                <h2>Create requisite form</h2>

                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li>
                                        <a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

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
                        </div>
                            @endforeach
                        @elseif($requisite instanceof \App\Requisite)
                            <div class="x_panel">
                                <div class="x_title">

                                    <h2>Create requisite form</h2>

                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li>
                                            <a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>

                                    <div class="clearfix"></div>
                                </div>

                                <div class="x_content">

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
                            </div>
                        @endif

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <button class="btn btn-large btn-primary" type="submit">Edit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
