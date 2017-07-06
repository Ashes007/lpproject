@extends('admin.layout')
@section('title','City')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        City
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">City List</li>
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
                 <div class="col-lg-6 col-sm-6 col-xs-6"><a href="{!! URL::Route('city_add') !!}" class="btn btn-info pull-right">Add New</a></div>
                 <div class="clearfix"></div>
              </div>              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>City Name</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($city_list->count()>0)
                @foreach($city_list as $city)
                <tr>
                  <td>{{ $city->name }}</td>
                  <td>{{ $city->state->name }}</td>
                  <td>{{ $city->country->name }}</td>
                  <td>{{ $city->status }}</td>
                  <td>
                  <a href="{!! URL::route('city_edit',$city->id) !!}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                  <a onclick="return confirm('Delete! Are you sure')" href="{!! URL::route('city_delete',$city->id) !!}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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