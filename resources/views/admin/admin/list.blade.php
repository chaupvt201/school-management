@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách Admin (Tổng: {{ $getRecord->total()}})</h1>
          </div> 
          <div class="col-sm-6" style="text-align: right;"> 
          <a href="{{ url('admin/admin/add')}}" class="btn btn-primary">Thêm mới Admin </a> 
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
                <h3 class="card-title">Tìm Admin</h3>
              </div>
              <form method="get" action=""> 
                <div class="card-body"> 
                  <div class="row">
                <div class="form-group col-md-3">
                    <label>Tên</label>
                    <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Họ tên">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Email address</label>
                    <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email"> 
                  </div> 
                  <div class="form-group col-md-3">
                    <label>Ngày tạo</label>
                    <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="date"> 
                  </div> 
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Tìm kiếm</button> 
                    <a href="{{ url('admin/admin/list')}}" class="btn btn-success" style="margin-top: 30px;">Xóa</a>
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
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Danh sách Admin</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên</th>
                      <th>Email</th>
                      <th>Ngày tạo</th> 
                      <th>Thao tác</th> 
                    </tr>
                  </thead>
                  <tbody> 
                    @php 
                    $pageNumber = request()->query('page', 1); 
                    $indexOffset = ($pageNumber - 1)* $getRecord->perPage();
                    @endphp
                    @foreach($getRecord as $value) 
                    <tr>
                      <td>{{ $loop->iteration + $indexOffset }}</td> 
                      <td>{{$value->name}}</td> 
                      <td>{{$value->email}}</td> 
                      <td>{{date('d-m-Y H:i A', strtotime($value->created_at)) }}</td> 
                      <td>
                        <a href="{{ url('admin/admin/edit/'.$value->id)}}" class="btn btn-warning">Sửa</a> 
                        <a href="{{url('admin/admin/delete/'.$value->id)}}" class="btn btn-danger" style="{{ ($getadmin == $value->id) ? 'display: none;' : ''}}">Xóa</a>
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

  