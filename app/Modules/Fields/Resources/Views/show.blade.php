@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> </h3>
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

                @include('block.flash_messages')

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Fields list</h2>

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
                                            <a href="{{route('fields.add')}}">Add field</a>
                                        </li>
                                        <li>
                                            <a href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete</a>
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

                            @if(!empty($fields) and $fields->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Default value</th>
                                            <th>Is many values</th>
                                            <th>Is required</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fields as $field)
                                        <tr>
                                            <th>{{$field->id}}</th>
                                            <th>{{$field->name}}</th>
                                            <th>{{$field->slug}}</th>
                                            <th>{{$field->description}}</th>
                                            <th>{{$field->default_value}}</th>
                                            <th>
                                                @if($field->is_many_values)
                                                    yes
                                                @else
                                                    no
                                                @endif
                                            </th>
                                            <th>
                                                @if($field->is_required)
                                                    yes
                                                @else
                                                    no
                                                @endif
                                            </th>
                                            <th>{{date('d.m.Y H:i', strtotime($field->created_at))}}</th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info">
                                    <h4>Fields not found</h4>
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
