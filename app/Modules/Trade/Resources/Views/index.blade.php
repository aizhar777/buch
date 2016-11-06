@extends('layouts.main')

@section('title', 'Trades -')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Trade list</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form action="" method="get">
                            <div class="input-group">
                                <input name="query" type="text" class="form-control" placeholder="Search in stock...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                @include('block.flash_messages')

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">

                        <div class="x_title">

                            <h2>List</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li>
                                    <a title="Create new trade" href="{{route('trade.create')}}">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

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
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
