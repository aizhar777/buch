@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$category->name or 'Error'}}
            <small>Category</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Categories</a></li>
            <li class="active">{{$category->name or 'Error'}}</li>
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
                <h3 class="box-title">{{$category->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('category')}}">All categories</a>
                    <a class="btn btn-box-tool" href="{{route('category.edit',['id' => $category->id])}}">Edit</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('category-{{$category->id}}-delete-form').submit();">Delete</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                </div>
                @include('forms.category_delete_form', ['id' => $category->id])
            </div>
            <div class="box-body">
                <div><b>ID:</b> {{$category->id}}</div>
                <div><b>Name:</b> {{$category->name}}</div>
                <div><b>Description:</b> {{$category->description}}</div>
                <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($category->created_at))}}</div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
