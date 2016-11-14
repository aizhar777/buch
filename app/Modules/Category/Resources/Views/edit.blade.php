@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$category->name or 'Error'}}
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Categoties</a></li>
            <li><a href="#">{{$category->name or 'Error'}}</a></li>
            <li class="active">Editing</li>
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


        <form action="{{route('category.data.edit',['id' => $category->id])}}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update category form</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{route('category')}}">All categories</a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="category_subcategory" class="control-label col-md-3 col-sm-3 col-xs-12">Is a subcategory</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="subcategory"  id="category_subcategory" type="checkbox" @if(!is_null($category->parent_id)) checked @endif >
                        </div>
                    </div>

                    <div class="form-group" id="wrapper_category_parent">
                        <label for="category_parent" class="control-label col-md-3 col-sm-3 col-xs-12">Category parent</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="category_parent" name="parent_id" class="form-control">
                                <option value="">Choose parent</option>
                                @if(!empty($cats))
                                    @foreach($cats as $cat)
                                        {!! $cat->renderNodeAsOption($cat, $category->parent_id) !!}
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="name"  id="category_name" type="text" class="form-control" placeholder="Category Name" value="{{$category->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="description" id="category_description" rows="4" class="form-control" placeholder="Category description">{{$category->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_type" class="control-label col-md-3 col-sm-3 col-xs-12">Category Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="category_type" name="cat_type" class="form-control">
                                <option>Choose Type</option>
                                @if(!empty($types))
                                    @foreach($types as $type)
                                        <option value="{{$type->class}}" @if($category->cat_type == $type->class) selected @endif >{{$type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-large btn-primary" type="submit">Edit</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection
