@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$stock->name or 'Error'}}
            <small>it all starts here</small>
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
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Storage: {{$stock->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('stock')}}">All store</a>
                    <a class="btn btn-box-tool" href="{{route('stock.edit',['id' => $stock->id])}}">Edit</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('stock-{{$stock->id}}-delete-form').submit();">Delete</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
                @include('forms.stock_delete_form', ['id' => $stock->id])
            </div>
            <div class="box-body">
                <div><b>Name:</b> {{$stock->name}}</div>
                <div><b>Slug:</b> {{$stock->slug}}</div>
                <div><b>Description:</b> {{$stock->description or 'Empty'}}</div>
                <div><b>Address:</b> {{$stock->address or 'None'}}</div>
                <div><b>Subdivision:</b> {{$stock->subdivision->name or 'Empty'}}</div>
                <div><b>Responsible:</b> {{$stock->user->name or 'None'}}</div>
                <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($stock->created_at))}}</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
