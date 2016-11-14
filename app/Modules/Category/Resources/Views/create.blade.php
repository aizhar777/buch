@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
            <small>Add new</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Categories</a></li>
            <li class="active">Add new</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @include('block.flash_messages')

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{route('category.data.create')}}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Title</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('category')}}">All categories</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="category_subcategory" class="control-label col-md-3 col-sm-3 col-xs-12">Create a subcategory</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="subcategory"  id="category_subcategory" type="checkbox" @if(!empty(old('subcategory'))) checked @endif >
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
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-large btn-default" type="submit">Create</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
