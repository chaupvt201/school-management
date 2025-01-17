@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm mới người quản trị</h1>
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
                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Họ tên">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Email"> 
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" name="password" required placeholder="Mật khẩu">
                  </div>
                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm mới</button>
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

  