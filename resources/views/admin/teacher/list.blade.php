@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách Giáo viên (Total: {{ $getRecord->total()}})</h1>
          </div> 
          <div class="col-sm-6" style="text-align: right;"> 
          <a href="{{ url('admin/teacher/add')}}" class="btn btn-primary">Thêm Giáo viên</a> 
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12"> 


          
            <div class="card card-primary"> 
            <div class="card-header">
                <h3 class="card-title">Tìm giáo viên</h3>
              </div>
              <form method="get" action=""> 
                <div class="card-body"> 
                  <div class="row">
                <div class="form-group col-md-2">
                    <label>Tên</label>
                    <input type="text" class="form-control" value="{{ Request::get('first_name') }}" name="first_name" placeholder="First Name">
                  </div> 
                  <div class="form-group col-md-2">
                    <label>Họ</label>
                    <input type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Last Name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email"> 
                  </div> 
                  <div class="form-group col-md-2">
                    <label>Giới tính</label> 
                    <select class="form-control" name="gender">
                        <option value="">Select Gender</option> 
                        <option {{ (Request::get('gender') == 'Male') ? 'selected' : ''}} value="Male">Male</option> 
                        <option {{ (Request::get('gender') == 'Female') ? 'selected' : ''}} value="Female">Female</option> 
                        <option {{ (Request::get('gender') == 'Other') ? 'selected' : ''}} value="Other">Other</option>
                    </select> 
                  </div> 
                  <div class="form-group col-md-2">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" value="{{ Request::get('mobile_number') }}" name="mobile_number" placeholder="Mobile Number"> 
                  </div> 
                  <div class="form-group col-md-2">
                    <label>Tình trạng hôn nhân</label>
                    <input type="text" class="form-control" value="{{ Request::get('marital_status') }}" name="marital_status" placeholder="Marital Status">
                  </div> 
                  <div class="form-group col-md-2">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" value="{{ Request::get('address') }}" name="address" placeholder="Last Name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Trạng thái</label> 
                    <select class="form-control" name="status"> 
                    <option value="">Select Status</option> 
                        <option {{ (Request::get('status') == '100') ? 'selected' : ''}} value="100">Active</option> 
                        <option {{ (Request::get('status') == '1') ? 'selected' : ''}} value="1">Inactive</option> 
                    </select>  
                  </div> 
                  <div class="form-group col-md-2">
                    <label>Ngày tạo</label>
                    <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="date"> 
                  </div> 
                  <div class="form-group col-md-2">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Tìm kiếm</button> 
                    <a href="{{ url('admin/teacher/list')}}" class="btn btn-success" style="margin-top: 30px;">Xóa</a>
                  </div>
                  </div>
                  
                  

                </div>
                <!-- /.card-body -->

                
              </form>
            </div>
            
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
            @include('message')
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Danh sách giáo viên</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>STT</th> 
                      <th>Ảnh đại diện</th>
                      <th>Họ tên</th>
                      <th>Email</th> 
                      <th>Giới tính</th> 
                      <th>Ngày sinh</th> 
                      <th>Số điện thoại</th> 
                      <th>Tình trạng hôn nhân</th> 
                      <th>Địa chỉ</th> 
                      <th>Bằng cấp</th>
                      <th>Trạng thái</th> 
                      <th>Ngày tạo</th> 
                      <th>Thao tác</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value) 
                    <tr>
                      <td>{{$value->user_id}}</td> 
                      <td>
                        @if(!empty($value->profile_pic)) 
                        <img src="{{ asset('upload/profile/'.$value->profile_pic)}}" style="height: 80px; width:80px; border-radius: 50px;"> 
                        @endif 
                      </td>
                      <td>{{$value->last_name}} {{$value->first_name}} </td> 
                      <td>{{$value->email}}</td> 
                      <td>{{$value->gender}}</td> 
                      <td>{{$value->date_of_birth}}</td> 
                      <td>{{$value->mobile_number}}</td> 
                      <td>{{$value->marital_status}}</td> 
                      <td>{{$value->address}}</td> 
                      <td>{{$value->qualification}}</td>
                      <td>{{$value->status}}</td> 
                      <td>{{date('d-m-Y H:i A', strtotime($value->created_at)) }}</td> 
                      <td style="min-width: 150px;"> 
                        <a href="{{ url('admin/teacher/edit/'.$value->user_id)}}" class="btn btn-warning btn-sm">Sửa</a> 
                        <a href="{{url('admin/teacher/delete/'.$value->user_id)}}" class="btn btn-danger btn-sm">Xóa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table> 
                <div style="padding: 10px; float: right;">
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} 
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->

        <!-- /.row -->
       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



 @endsection 

  