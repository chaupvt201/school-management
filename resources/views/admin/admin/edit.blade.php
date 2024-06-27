@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Admin</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card card-primary">
              <form method="post" action=""> 
                {{csrf_field()}} 
                <div class="card-body"> 
                  @foreach($getRecord as $value)
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $value->name)}}" required placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $value->email)}}" required placeholder="Email"> 
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password"> 
                    <p>Do you want to change password so Please add new password</p>
                  </div> 
                  @endforeach 
                  

                </div> 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button> 
                </div>
              </form>
            </div>
            
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



 @endsection 

  