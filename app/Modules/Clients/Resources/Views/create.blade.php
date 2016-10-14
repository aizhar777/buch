@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Add new client</h3>
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


                    <form action="{{route('clients.data.create')}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Create client form</h2>

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
                                        <input name="name"  id="client_name" type="text" class="form-control" placeholder="Client Name" value="{{old('name')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="client_email" class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="email"  id="client_email" type="text" class="form-control" placeholder="Client email" value="{{old('email')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="client_phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="phone"  id="client_phone" type="text" class="form-control" placeholder="Client phone" value="{{old('phone')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="client_curator" class="control-label col-md-3 col-sm-3 col-xs-12">Client curator</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="client_curator" name="curator" class="form-control">
                                            <option>Choose curator</option>
                                            @if(!empty($curators))
                                                @foreach($curators as $curator)
                                                    <option value="{{$curator->id}}" @if(old('curator') == $curator->id) selected @endif >{{$curator->id}}# {{$curator->name}} ({{$curator->email}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>

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
                                        <input name="legal_name" id="requisite_legal_name" type="text" class="form-control" placeholder="Client legal name" value="{{old('legal_name')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="requisite_bank" class="control-label col-md-3 col-sm-3 col-xs-12">Bank</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="bank" id="requisite_bank" type="text" class="form-control" placeholder="Client's bank" value="{{old('bank')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="requisite_iik" class="control-label col-md-3 col-sm-3 col-xs-12">IIK</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="iik" id="requisite_iik" type="text" class="form-control" placeholder="Client's iik" value="{{old('iik')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="requisite_bin" class="control-label col-md-3 col-sm-3 col-xs-12">BIN</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="bin" id="requisite_bin" type="text" class="form-control" placeholder="Client's bin" value="{{old('bin')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="requisite_cbe" class="control-label col-md-3 col-sm-3 col-xs-12">CBE</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="cbe" id="requisite_cbe" type="text" class="form-control" placeholder="Client's cbe" value="{{old('cbe')}}">
                                    </div>
                                </div>


                        </div>
                    </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <button class="btn btn-large btn-primary" type="submit">Create</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
