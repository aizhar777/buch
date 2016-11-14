@extends('layouts.main')

@section('title', 'Trades -')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Trades
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Trades</a></li>
            <li class="active">list</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($trades) and $trades->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Trade ID</th>
                            <th>Status</th>
                            <th>PPC</th>
                            <th>Curator</th>
                            <th>Client</th>
                            <th>Payment is completed</th>
                            <th>Products</th>
                            <th>Date</th>
                            <th>Action</th>
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
                                        <h4 class="modal-title" id="exampleModalLabel">Add Product</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><i class="fa fa-refresh fa-spin fa-fw"></i> Wait..</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" onclick="" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="application.addProductFormSend(true);">Add products</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @else
                    <div class="alert alert-info">
                        <h4>Trade not found</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($trades->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$trades->appends(['items' => request('items')])->links()}}
                    @else
                        {{$trades->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
