@extends('layouts.main')

@section('title', trans('trade::module.trade_title',['id' => $trade->id]))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('trade::module.trade_title',['id'=> $trade->id])}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li><a href="{{route('trade')}}">{{trans('modules.breadcrumbs.trades')}}</a></li>
            <li class="active">{{trans('trade::module.trade_title',['id'=> $trade->id])}}</li>
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
                            {{ $status->description }}
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
                <h3 class="box-title">{{trans('trade::module.trade_title',['id'=> $trade->id])}} <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#add-product-modal" data-trade="{{$trade->id}}">{{trans('trade::module.module_links.add_products')}}</a></h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'check', 'format' => 'portrait'])}}">{{trans('modules.printer.check')}} ({{trans('modules.printer.portrait')}})</a>
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'order', 'format' => 'portrait'])}}">{{trans('modules.printer.order')}} ({{trans('modules.printer.portrait')}})</a>
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'invoice', 'format' => 'portrait'])}}">{{trans('modules.printer.invoice')}} ({{trans('modules.printer.portrait')}})</a>
                    <a class="btn btn-box-tool" target="_blank" href="{{route('printer.trade',['id' => $trade->id, 'type' => 'certificate', 'format' => 'landscape'])}}">{{trans('modules.printer.certificate')}} ({{trans('modules.printer.landscape')}})</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">

                <div><b>{{ trans('trade::module.view.ppc') }}:</b>
                    @if($trade->ppCode)
                        <abbr title="{{$trade->ppCode->description}}"
                              class="initialism">{{$trade->ppCode->code or 'None'}}</abbr>
                    @else
                        ID# {{$trade->ppc}}
                    @endif
                </div>
                <div><b>{{ trans('trade::module.view.curator') }}:</b>
                    @if($trade->supervisor)
                        <a href="{{route('user.profile',['id' => $trade->supervisor->id])}}"><i
                                    class="fa fa-user"></i> {{$trade->supervisor->name}}</a>
                    @else
                        ID# {{$trade->curador}}
                    @endif
                </div>
                <div><b>{{ trans('trade::module.view.client') }}:</b>
                    @if($trade->client)
                        <a href="{{route('clients',['id' => $trade->client->id])}}"><i
                                    class="fa fa-user"></i> {{$trade->client->name}}</a>
                    @else
                        ID# {{$trade->client_id}}
                    @endif
                </div>
                <div><b>{{ trans('trade::module.view.payment_is_completed') }}:</b>
                    @if($trade->payment_is_completed)
                        @if($trade->completer)
                            {!! trans('trade::module.view.is_complete',['link' => route('user.profile',['id' => $trade->completer->id]), 'username' => $trade->completer->name]) !!}
                        @else
                            {{ trans('trade::module.view.user_id_by_complete', ['id' => $trade->completed_by_user]) }}
                        @endif
                    @else
                        {{ trans('trade::module.view.is_not_complete') }}
                    @endif
                </div>
                <div><b>{{ trans('trade::module.view.created_date') }}:</b> {{date('d.m.Y H:i', strtotime($trade->created_at))}}</div>

                <div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="add_products_push" action="{{route('trade.add.products')}}">
                                {{csrf_field()}}
                                {{method_field("PUT")}}
                                <input type="hidden" name="trade" value="null">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">{{trans('trade::module.module_links.add_products')}}</h4>
                                </div>
                                <div class="modal-body">
                                    <p><i class="fa fa-refresh fa-spin fa-fw"></i> Wait..</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('modules.menu.context.close') }}</button>
                                    <button type="button" class="btn btn-primary" onclick="application.addProductFormSend(false);">{{trans('trade::module.module_links.add_products')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div>
                    <a href="{{route('trade.get.products',['id' => $trade->id])}}"
                       data-load="none"
                       data-title-update="{{ trans('trade::module.view.button_update_trade_products') }}"
                       onclick="event.preventDefault();application.getTradeProducts();"
                       id="show_trade_products">
                        {{ trans('trade::module.view.button_show_trade_products') }}
                    </a>
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
                    <h3 class="box-title">{{ trans('trade::module.view.trade_history') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
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
