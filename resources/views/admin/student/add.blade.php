@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
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
              <form method="post" action="" enctype="multipart/form-data"> 
                {{csrf_field()}} 
                <div class="card-body"> 
                    <div class="row">
                  <div class="form-group col-md-6">
                    <label>Họ <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Họ"> 
                    <div style="color:red">{{ $errors->first('last_name') }}</div>
                  </div> 
                <div class="form-group col-md-6">
                    <label>Tên <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('first_name') }}" name="first_name" required placeholder="Tên"> 
                    <div style="color:red">{{ $errors->first('first_name') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Lớp <span style="color: red;">*</span></label> 
                    <select class="form-control" required name="class_id">
                        <option value="">Chọn lớp</option> 
                        @foreach($getClass as $value) 
                        <option {{ (old('class_id') == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach 
                    </select> 
                    <div style="color:red">{{ $errors->first('class_id') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Giới tính <span style="color: red;">*</span></label> 
                    <select class="form-control" required name="gender">
                        <option value="">Chọn giới tính</option> 
                        <option {{ (old('gender') == 'Nam') ? 'selected' : ''}} value="Nam">Nam</option> 
                        <option {{ (old('gender') == 'Nữ') ? 'selected' : ''}} value="Nữ">Nữ</option> 
                        <option {{ (old('gender') == 'Khác') ? 'selected' : ''}} value="Khác">Khác</option>
                    </select> 
                    <div style="color:red">{{ $errors->first('gender') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Ngày sinh </label> 
                    <input type="date" class="form-control" value="{{ old('date_of_birth')}}" name="date_of_birth" required > 
                    <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Số điện thoại <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('mobile_number') }}" name="mobile_number" required placeholder="Số điện thoại"> 
                    <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                  </div>  
                  <div class="form-group col-md-6">
                    <label>Ảnh đại diện </label>
                    <input type="file" class="form-control" name="profile_pic"> 
                    <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                  </div>  
                  <div class="form-group col-md-6">
                    <label>Trạng thái <span style="color: red;">*</span></label> 
                    <select class="form-control" required name="status">
                        <option value="">Chọn trạng thái</option> 
                        <option {{ old('status') == 0 ? 'selected' : ''}} value="0">Kích hoạt</option> 
                        <option {{ old('status') == 1 ? 'selected' : ''}} value="1">Không kích hoạt</option> 
                    </select> 
                    <div style="color:red">{{ $errors->first('status') }}</div>
                  </div> 
                   </div> 
                   <br/> 


                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Email"> 
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
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

  