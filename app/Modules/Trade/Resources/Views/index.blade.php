@extends('layouts.main')

@section('title', 'Trades -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('modules.breadcrumbs.trades')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  {{trans('modules.breadcrumbs.dashboard')}}</a></li>
            <li class="active">{{trans('modules.breadcrumbs.trades')}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('modules.list') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($trades) and $trades->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('trade::view.table.trade_id') }}</th>
                            <th>{{ trans('trade::view.table.status') }}</th>
                            <th>{{ trans('trade::view.table.ppc') }}</th>
                            <th>{{ trans('trade::view.table.curator') }}</th>
                            <th>{{ trans('trade::view.table.client') }}</th>
                            <th>{{ trans('trade::view.table.payment_is_completed') }}</th>
                            <th>{{ trans('trade::view.table.products') }}</th>
                            <th>{{ trans('trade::view.table.date') }}</th>
                            <th>{{ trans('trade::view.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @each('trade::each.trades_table', $trades, 'trade')

                        </tbody>
                    </table>

                    <div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" id="add_products_push" action="{{route('trade.add.products')}}">
                                    {{csrf_field()}}
                                    {{method_field("PUT")}}
                                    <input type="hidden" name="trade" value="null">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="exampleModalLabel">{{ trans('trade::view.modal.add_product') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><i class="fa fa-refresh fa-spin fa-fw"></i> {{ trans('trade::view.modal.wait') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" onclick="" class="btn btn-default" data-dismiss="modal">{{ trans('modules.menu.context.close') }}</button>
                                        <button type="button" class="btn btn-primary" onclick="application.addProductFormSend(true);">{{ trans('trade::view.modal.add_product') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @else
                    <div class="alert alert-info">
                        <h4>{{ trans('trade::view.trade_not_found') }}</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($trades->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{ $trades->appends(['items' => request('items')])->links() }}
                    @else
                        {{ $trades->links() }}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
