@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$subdivision->name or 'Error'}}
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

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Subdivision: {{$subdivision->name or 'Error'}}</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('subdivision')}}">All subdivisions</a>
                    <a class="btn btn-box-tool" href="{{route('subdivision.edit',['id' => $subdivision->id])}}">Edit</a>
                    <a class="btn btn-box-tool" onclick="event.preventDefault();document.getElementById('subdivision-{{$subdivision->id}}-delete-form').submit();">Delete</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
                @include('forms.delete_form', ['id' => $subdivision->id, 'slug' => 'subdivision'])
            </div>
            <div class="box-body">
                <div><b>Name:</b> {{$subdivision->name}}</div>
                <div><b>Slug:</b> {{$subdivision->slug}}</div>
                <div><b>Description:</b> {{$subdivision->description or 'Empty'}}</div>
                <div><b>Address:</b> {{$subdivision->address or 'None'}}</div>
                <div><b>Responsible:</b> {{$subdivision->user->name or 'None'}}</div>
                <div><b>Date:</b> {{date('d.m.Y H:i', strtotime($subdivision->created_at))}}</div>
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
