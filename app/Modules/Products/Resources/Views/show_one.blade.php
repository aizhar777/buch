@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$product->name or 'Error'}}
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Products</a></li>
            <li class="active">{{$product->name or 'Error'}}</li>
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
                <h3 class="box-title">Product: {{$product->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('products')}}">All products</a>
                    <a class="btn btn-box-tool" href="{{route('products.edit',['id' => $product->id])}}">Edit this</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('products-{{$product->id}}-delete-form').submit();">Delete</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
                @include('forms.products_delete_form', ['id' => $product->id])
            </div>
            <div class="box-body">
                <div><b>Name:</b> {{$product->name}}</div>
                <div><b>Description:</b> {{$product->description}}</div>
                <div><b>Price:</b> {{$product->price}}</div>
                <div><b>Cost:</b> {{$product->cost}}</div>
                <div><b>Is a service:</b>
                    @if($product->is_service)
                        Yes
                    @else
                        No
                    @endif
                </div>
                <div><b>Balance:</b> {{$product->balance}}</div>
                <div><b>Stock:</b> {{$product->stock->name or $product->stock_id}}</div>
                <div><b>Subdivision:</b> {{$product->subdivision->name or $product->subdivision_id}}</div>
                <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($product->created_at))}}</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
