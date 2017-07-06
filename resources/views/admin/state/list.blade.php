@extends('admin.layout')
@section('title','State')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        State
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">State List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->
          @if (session('message'))
              <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('message') }}
              </div>
          @endif
          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-xs-6"><h3 class="box-title">Listing</h3></div>
                 <div class="col-lg-6 col-sm-6 col-xs-6"><a href="{!! URL::Route('state_add') !!}" class="btn btn-info pull-right">Add New</a></div>
                 <div class="clearfix"></div>
              </div>              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>State Name</th>
                  <th>State Code</th>
                  <th>Country</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($state_list->count()>0)
                @foreach($state_list as $state)
                <tr>
                  <td>{{ $state->name }}</td>
                  <td>{{ $state->code }}</td>
                  <td>{{ $state->country->name }}</td>
                  <td>{{ $state->status }}</td>
                  <td>
                  <a href="{!! URL::route('state_edit',$state->id) !!}"><i class="fa fa-edit"></i></a>
                  <a onclick="return confirm('Delete! Are you sure')" href="{!! URL::route('state_delete',$state->id) !!}"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
                @else
                  <tr><td colspan="5"> No Record Found</td></tr>
                @endif
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection