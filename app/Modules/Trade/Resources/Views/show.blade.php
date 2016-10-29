@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Trade № {{$trade->id or 'Error'}}</h3>
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

                <div class="col-md-12 col-sm-12 col-xs-12 wizard_horizontal">
                    <ul class="wizard_steps">
                        @foreach($statuses as $status)
                        <li>
                            <a href="#{{$status->id}}" class=" @if($trade->status == $status->id) selected @else disabled @endif " >
                                <span class="step_no">
                                     @if($status->level <= 100)
                                        {{$status->level}}%
                                     @elseif($status->level == 101)
                                        <i class="fa fa-lock"></i>
                                     @elseif($status->level == 110)
                                        <i class="fa fa-archive"></i>
                                     @endif
                                </span>
                                <span class="step_descr">
                                    {{$status->name}}<br/>
                                    <small>{{$status->description}}</small>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">

                    @include('block.flash_messages')

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Trade</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li>
                                    <a href="{{route('trade')}}" title="All trades"><i class="fa fa-th-list"></i></a>
                                </li>
                                <li>
                                    <a href="{{route('trade.edit',['id' => $trade->id])}}" title="Edit"><i
                                                class="fa fa-pencil-square"></i></a>
                                </li>
                                <li>
                                    <a onclick="event.preventDefault();document.getElementById('trade-{{$trade->id}}-delete-form').submit();"
                                       title="Delete"><i class="fa fa-trash"></i></a>
                                </li>
                            </ul>
                            @include('forms.delete_form', ['id' => $trade->id, 'slug' => 'trade'])

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div><b>PPC:</b>
                                @if($trade->ppCode)
                                    <abbr title="{{$trade->ppCode->description}}"
                                          class="initialism">Code: {{$trade->ppCode->code or 'None'}}</abbr>
                                @else
                                    ID# {{$trade->ppc}}
                                @endif
                            </div>
                            <div><b>Curator:</b>
                                @if($trade->supervisor)
                                    <a href="{{route('user.profile',['id' => $trade->supervisor->id])}}"><i
                                                class="fa fa-user"></i> {{$trade->supervisor->name}}</a>
                                @else
                                    ID# {{$trade->curador}}
                                @endif
                            </div>
                            <div><b>Client:</b>
                                @if($trade->client)
                                    <a href="{{route('clients',['id' => $trade->client->id])}}"><i
                                                class="fa fa-user"></i> {{$trade->client->name}}</a>
                                @else
                                    ID# {{$trade->client_id}}
                                @endif
                            </div>
                            <div><b>Payment is completed:</b>
                                @if($trade->payment_is_completed)
                                    Completed by @if($trade->completer)
                                        <a href="{{route('user.profile',['id' => $trade->completer->id])}}"><i
                                                    class="fa fa-user"></i> {{$trade->completer->name}}</a>
                                    @else
                                        User ID: {{$trade->completed_by_user}}
                                    @endif
                                @else
                                    Is not complete
                                @endif
                            </div>
                            <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($trade->created_at))}}</div>

                        </div>
                    </div>

                    <div id="trade_products_wrapper">
                        <a href="{{route('trade.get.products',['id' => $trade->id])}}" data-load="none"
                           onclick="event.preventDefault();application.getTradeProducts();" id="show_trade_products">Show
                            trade products</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
