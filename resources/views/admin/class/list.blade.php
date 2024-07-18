@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách lớp học</h1>
          </div> 
          <div class="col-sm-6" style="text-align: right;"> 
          <a href="{{ url('admin/class/add')}}" class="btn btn-primary">Thêm lớp học</a> 
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
                <h3 class="card-title">Tìm lớp học</h3>
              </div>
              <form method="get" action=""> 
                <div class="card-body"> 
                  <div class="row">
                <div class="form-group col-md-3">
                    <label>Tên lớp</label>
                    <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Ngày tạo</label>
                    <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="date"> 
                  </div> 
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Tìm kiếm</button> 
                    <a href="{{ url('admin/class/list')}}" class="btn btn-success" style="margin-top: 30px;">Xóa</a>
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
                <h3 class="card-title">Danh sách lớp học</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên lớp</th>
                      <th>Trạng thái</th> 
                      <th>Ngày tạo</th> 
                      <th>Thao tác</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value) 
                    <tr>
                        <td>{{ $value->id }}</td> 
                        <td>{{ $value->name }}</td> 
                        <td>
                            @if($value->status == 0) 
                            <div class="btn btn-success">Active </div>
                            @else 
                            <div class="btn btn-danger">Inactive </div>
                            @endif 
                        </td> 
                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td> 
                        <td>
                        <a href="{{ url('admin/class/edit/'.$value->id)}}" class="btn btn-warning">Sửa</a> 
                        <a onclick="confirmation(event)" href="{{url('admin/class/delete/'.$value->id)}}" class="btn btn-danger">Xóa</a>
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
@section('script') 
<script type="text/javascript">
  function confirmation(ev){
    ev.preventDefault(); 
    var urlToRedirect = ev.currentTarget.getAttribute('href'); 
    console.log(urlToRedirect); 
    swal({
      title: "Bạn có chắc chắn muốn xóa không ?", 
      text: "Bạn không thể hoàn tác thao tác này", 
      icon: "warning", 
      buttons: true, 
      dangerMode: true, 
    }) 
    .then((willCancel) => {
      if(willCancel){
        window.location.href = urlToRedirect; 
      }
    }); 
  }
</script>
@endsection 

  