@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Subdivision
            <small>list</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Subdivisions</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    @include('block.flash_messages')

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    <a class="btn btn-box-tool" href="{{route('subdivision.create')}}">Add subdivision</a>
                </div>
            </div>
            <div class="box-body">

                @if(!empty($subdivisions) and $subdivisions->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Responsible</th>
                            <th>address</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subdivisions as $sub)
                            <tr>
                                <th>{{$sub->id}}</th>
                                <th>{{$sub->name}}</th>
                                <th>{{$sub->slug}}</th>
                                <th>{{$sub->description or 'Empty'}}</th>
                                <th>
                                    @if(!is_null($sub->responsible))
                                        {{$sub->user->name}}
                                    @else
                                        None
                                    @endif
                                </th>
                                <th>{{$sub->address or 'Empty'}}</th>
                                <th>{{date('d.m.Y H:i', strtotime($sub->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-small btn-primary" href="{{route('subdivision.show', ['id'=> $sub->id])}}"> View</a>
                                        <a class="btn btn-small btn-primary" href="{{route('subdivision.edit', ['id'=> $sub->id])}}"> Edit</a>
                                        <a class="btn btn-small btn-primary" onclick="event.preventDefault();document.getElementById('subdivision-{{$sub->id}}-delete-form').submit();"> delete</a>
                                    </div>
                                    @include('forms.delete_form', ['id' => $sub->id, 'slug' => 'subdivision'])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info">
                        <h4>Subdivision not found</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($subdivisions->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$subdivisions->appends(['items' => request('items')])->links()}}
                    @else
                        {{$subdivisions->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
