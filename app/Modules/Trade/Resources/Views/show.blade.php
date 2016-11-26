@extends('layouts.main')

@section('title', 'Trade #' . $trade->id . ' -')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Trade № {{$trade->id or 'Error'}}
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Trades</a></li>
            <li class="active">{{$trade->id or 'Error'}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @foreach($statuses as $status)
            @if($trade->status == $status->id)
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{$status->name}}</span>
                        <span class="info-box-number">{{$status->level}}%</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: {{$status->level}}%"></div>
                        </div>
                        <span class="progress-description">
                            {{$status->description}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            @else
            @endif
        @endforeach

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

        <!-- Default box -->
        <div class="box" id="trade_box">
            <div class="box-header with-border">
                <h3 class="box-title">Trade № {{$trade->id or 'Error'}} <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#add-product-modal" data-trade="{{$trade->id}}">Add product</a></h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'check', 'format' => 'portrait'])}}">Check (portrait)</a>
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'order', 'format' => 'portrait'])}}">Order (portrait)</a>
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'invoice', 'format' => 'portrait'])}}">Invoice (portrait)</a>
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'certificate', 'format' => 'landscape'])}}">Certificate of completion (landscape)</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">

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

                <div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="add_products_push" action="{{route('trade.add.products')}}">
                                {{csrf_field()}}
                                {{method_field("PUT")}}
                                <input type="hidden" name="trade" value="null">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Add Product</h4>
                                </div>
                                <div class="modal-body">
                                    <p><i class="fa fa-refresh fa-spin fa-fw"></i> Wait..</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="application.addProductFormSend(false);">Add products</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div>
                    <a href="{{route('trade.get.products',['id' => $trade->id])}}" data-load="none"
                       onclick="event.preventDefault();application.getTradeProducts();" id="show_trade_products">Show
                        trade products</a>
                </div>
                <div id="trade_products_wrapper"></div>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

            @if($trade->history->count() > 0)
            <!-- Default box -->
            <div class="box collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Trade History</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                        <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div>
                <div class="box-body">

                    <ul class="timeline">

                        <!-- timeline time label
                        <li class="time-label">
                            <span class="bg-red">
                                10 Feb. 2014
                            </span>
                        </li>
                        /.timeline-label -->
                        @foreach($trade->history as $hs)
                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-clock-o bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{date("d-m-Y H:i", strtotime($hs->created_at))}}</span>

                                <h3 class="timeline-header">{{$hs->title}}</h3>

                                <div class="timeline-body">
                                    <p>{!! $hs->description !!}</p>
                                </div>

                                <!--<div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">...</a>
                                </div>-->
                            </div>
                        </li>
                        <!-- END timeline item -->
                        @endforeach
                    </ul>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            @endif

    </section>
    <!-- /.content -->
@endsection
