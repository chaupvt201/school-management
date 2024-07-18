@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách học viên của tôi</h1>
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


          
            
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
            @include('message')
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách học viên</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th> 
                      <th>Ảnh đại diện</th>
                      <th>Họ tên</th>
                      <th>Email</th> 
                      <th>Lớp</th> 
                      <th>Giới tính</th> 
                      <th>Ngày sinh</th> 
                      <th>Số điện thoại</th> 
                      <th>Ngày tạo</th> 
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
                      <td>{{$value->class_name}}</td> 
                      <td>{{$value->gender}}</td> 
                      <td>{{$value->date_of_birth}}</td> 
                      <td>{{$value->mobile_number}}</td> 
                      <td>{{date('d-m-Y H:i A', strtotime($value->created_at)) }}</td> 
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

  