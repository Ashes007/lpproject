@extends('admin.layout')
@section('title','City')
@section('content') 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        City Edit
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">City Edit</li>
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
                    <select name="country_id" id="country_id" class="form-control" required>
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
                  <label for="inputPassword3" class="col-sm-2 control-label">State</label>

                  <div class="col-sm-10">
                    <select name="state_id" id="state_id" class="form-control">
                      <option value="">Select</option>
                      @if($state_list)
                          @foreach($state_list as $id=>$state)
                            <option value="{{ $id }}" {{ ($record->state_id == $id) ? 'selected' : '' }}>{{ $state }}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">City Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="city_name" name="city_name" value="{{ $record->name }}" placeholder="City Name" required>
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