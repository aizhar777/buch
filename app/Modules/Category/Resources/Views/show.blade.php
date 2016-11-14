@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
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

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Categories</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('category.create')}}">Add category</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                </div>
            </div>
            <div class="box-body">

                @if(!empty($categories) and $categories->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th>{{$category->id}}</th>
                                <th>{{$category->name}}</th>
                                <th>{{$category->description}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($category->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-small btn-primary btn-round" href="{{route('category', ['id'=> $category->id])}}"> View</a>
                                        <a class="btn btn-small btn-primary btn-round" href="{{route('category.edit', ['id'=> $category->id])}}"> Edit</a>
                                        <a class="btn btn-small btn-primary btn-round" onclick="event.preventDefault();document.getElementById('category-{{$category->id}}-delete-form').submit();"> delete</a>
                                    </div>
                                    @include('forms.category_delete_form', ['id' => $category->id])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>Categories not found</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($categories->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$categories->appends(['items' => request('items')])->links()}}
                    @else
                        {{$categories->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
