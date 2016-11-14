@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fields
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
                <h3 class="box-title">Fields list</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" href="{{route('fields.add')}}">Add field</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button-->
                </div>
            </div>
            <div class="box-body">

                @if(!empty($fields) and $fields->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Default value</th>
                            <th>Is many values</th>
                            <th>Is required</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fields as $field)
                            <tr>
                                <th>{{$field->id}}</th>
                                <th>{{$field->name}}</th>
                                <th>{{$field->slug}}</th>
                                <th>{{$field->description}}</th>
                                <th>{{$field->default_value}}</th>
                                <th>
                                    @if($field->is_many_values)
                                        yes
                                    @else
                                        no
                                    @endif
                                </th>
                                <th>
                                    @if($field->is_required)
                                        yes
                                    @else
                                        no
                                    @endif
                                </th>
                                <th>{{date('d.m.Y H:i', strtotime($field->created_at))}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a class="btn btn-small btn-primary btn-round" href="{{route('fields.edit', ['id'=> $field->id])}}"> Edit</a>
                                        <a class="btn btn-small btn-primary btn-round" onclick="event.preventDefault();document.getElementById('fields-{{$field->id}}-param-delete-form').submit();"> delete</a>
                                    </div>
                                    @include('forms.fields_delete_form', ['id' => $field->id])
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <h4>Fields not found</h4>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                @if($fields->total() > 1 )
                    @if(request()->has('items') && is_numeric(request('items')))
                        {{$fields->appends(['items' => request('items')])->links()}}
                    @else
                        {{$fields->links()}}
                    @endif
                @endif
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
