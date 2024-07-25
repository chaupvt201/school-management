@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật tài khoản giáo viên</h1>
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
                    <input type="text" class="form-control" value="{{ old('last_name', $getRecord->last_name) }}" name="last_name" required placeholder="Họ"> 
                    <div style="color:red">{{ $errors->first('first_name') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Tên <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('first_name', $getRecord->first_name) }}" name="first_name" required placeholder="Tên"> 
                    <div style="color:red">{{ $errors->first('last_name') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Giới tính <span style="color: red;">*</span></label> 
                    <select class="form-control" required name="gender">
                        <option value="">Chọn giới tính</option> 
                        <option {{ (old('gender', $getRecord->gender) == 'Nam') ? 'selected' : ''}} value="Nam">Nam</option> 
                        <option {{ (old('gender', $getRecord->gender) == 'Nữ') ? 'selected' : ''}} value="Nữ">Nữ</option> 
                        <option {{ (old('gender', $getRecord->gender) == 'Khác') ? 'selected' : ''}} value="Khác">Khác</option>
                    </select> 
                    <div style="color:red">{{ $errors->first('gender') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Ngày sinh </label> 
                    <input type="date" class="form-control" value="{{ old('date_of_birth', $getRecord->date_of_birth)}}" name="date_of_birth" required > 
                    <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Số điện thoại <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('mobile_number', $getRecord->mobile_number) }}" name="mobile_number" required placeholder="Số điện thoại"> 
                    <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                  </div>  
                  <div class="form-group col-md-6">
                    <label>Tình trạng kết hôn <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('marital_status', $getRecord->marital_status) }}" name="marital_status" required placeholder="Tình trạng kết hôn">
                    <div style="color:red">{{ $errors->first('marital_status') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Địa chỉ <span style="color: red;">*</span></label>
                    <textarea style="resize: none;" class="form-control" required name="address">{{ old('address', $getRecord->address) }}</textarea>
                    <div style="color:red">{{ $errors->first('address') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Trình độ <span style="color: red;">*</span></label>
                    <textarea style="resize: none;" class="form-control" required name="qualification">{{ old('qualification', $getRecord->qualification) }}</textarea>
                    <div style="color:red">{{ $errors->first('qualification') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Ảnh đại diện</label>
                    <input type="file" class="form-control" name="profile_pic"> 
                    <div style="color:red">{{ $errors->first('profile_pic') }}</div> 
                    @if(!empty($getRecord->profile_pic)) 
                    <img src="{{ asset('upload/profile/'.$getRecord->profile_pic) }}" style="width: 100px;"> 
                    @endif 
                  </div>  
                  <div class="form-group col-md-6">
                    <label>Trạng thái <span style="color: red;">*</span></label> 
                    <select class="form-control" required name="status">
                        <option value="">Chọn trạng thái</option> 
                        <option {{ old('status', $getRecord->status) == 0 ? 'selected' : ''}} value="0">Kích hoạt</option> 
                        <option {{ old('status', $getRecord->status) == 1 ? 'selected' : ''}} value="1">không kích hoạt</option> 
                    </select> 
                    <div style="color:red">{{ $errors->first('status') }}</div>
                  </div> 
                   </div> 
                   <br/> 


                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" name="email" required placeholder="Email"> 
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu"> 
                    <p>Nếu bạn muốn đổi mật khẩu hãy nhập mật khẩu mới</p> 
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
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

  