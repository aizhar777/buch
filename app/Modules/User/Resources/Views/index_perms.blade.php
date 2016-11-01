@extends('layouts.main')

@section('title', 'Permissions -')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Permissions list</h3>
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
                                    <a title="Create new trade" href="{{route('user.perms.create')}}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            @if(!empty($perms) and $perms->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @each('user::each.perms_table', $perms, 'permission')

                                    </tbody>
                                </table>
                                {{ $perms->links() }}
                            @else
                                <div class="alert alert-info">
                                    <h4>Permissions not found</h4>
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
