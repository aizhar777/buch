@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{$category->name or 'Error'}}</h3>
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

                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Category: {{$category->name or 'Error'}}</h2>

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
                                            <a href="{{route('category')}}">All categories</a>
                                        </li>
                                        <li>
                                            <a href="{{route('category.edit',['id' => $category->id])}}">Edit</a>
                                        </li>
                                        <li>
                                            <a onclick="event.preventDefault();document.getElementById('category-{{$category->id}}-delete-form').submit();">Delete</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            @include('forms.category_delete_form', ['id' => $category->id])

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div><b>ID:</b> {{$category->id}}</div>
                            <div><b>Name:</b> {{$category->name}}</div>
                            <div><b>Description:</b> {{$category->description}}</div>
                            <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($category->created_at))}}</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
