@extends('admin.layout')
@section('title','Dashboard')
@section('content') 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        State Edit
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">State Edit</li>
      </ol>
    </section>

      
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Horizontal Form</h3> -->

              @if (count($errors) > 0)
                 <div class = "alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                 </div>
              @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
            {{ csrf_field() }}
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Country</label>

                  <div class="col-sm-10">
                    <select name="country_id" class="form-control" required>
                      <option value="">Select</option>
                      @if($country_list)
                          @foreach($country_list as $id=>$country)
                            <option value="{{ $id }}" {!! ($id == $record->country_id)? 'selected' : '' !!} >{{ $country }}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">State Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="state_name" name="state_name" value="{{ $record->name }}" placeholder="State Name" required>
                  </div>
                </div>
                <div class="form-group {{ $errors->has('state_code') ? 'has-error' : ''}}">
                  <label for="inputPassword3" class="col-sm-2 control-label" >State Code</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="state_code"  name="state_code" value="{{ $record->code }}" placeholder="State Code" required>
                    {!! $errors->first('state_code', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Status</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="status" required>
                    <option value="">Select</option>
                    <option value="Active"  {{ ($record->status == 'Active')?'selected':'' }}>Active</option>
                    <option value="Inactive" {{ ($record->status == 'Inactive')?'selected':'' }}>Inactive</option>
                    </select>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Update</button>
                <a href="{{ URL::route('city') }}" class="btn btn-default">Cancel</a>
                
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   @endsection