@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Add new category</h3>
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


                    <form action="{{route('category.data.create')}}" method="post" class="form-horizontal form-label-left">
                        {{csrf_field()}}

                        <div class="x_panel">
                            <div class="x_title">

                                <h2>Create category form</h2>

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
                                        </ul>

                                    </li>

                                </ul>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <div class="form-group">
                                    <label for="category_subcategory" class="control-label col-md-3 col-sm-3 col-xs-12">Create a subcategory</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="subcategory"  id="category_subcategory" type="checkbox" @if(!empty(old('subcategory'))) selected @endif >
                                    </div>
                                </div>

                                <div class="form-group" id="wrapper_category_parent">
                                    <label for="category_parent" class="control-label col-md-3 col-sm-3 col-xs-12">Category parent</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="category_parent" name="parent_id" class="form-control">
                                            <option value="">Choose parent</option>
                                            @if(!empty($cats))
                                                @foreach($cats as $cat)
                                                    {!! $cat->renderNodeAsOption($cat, old('parent_id')) !!}
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="name"  id="category_name" type="text" class="form-control" placeholder="Category Name" value="{{old('name')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category_description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea name="description" id="category_description" rows="4" class="form-control" placeholder="Category description">{{old('description')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category_type" class="control-label col-md-3 col-sm-3 col-xs-12">Category Type</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="category_type" name="cat_type" class="form-control">
                                            <option>Choose Type</option>
                                            @if(!empty($types))
                                                @foreach($types as $type)
                                                    <option value="{{$type->class}}" @if(old('cat_type') == $type->class) selected @endif >{{$type->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
