@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Subject List</h1>
          </div> 
          <div class="col-sm-6" style="text-align: right;"> 
          <a href="{{ url('admin/assign_subject/add')}}" class="btn btn-primary">Add New Assign Subject</a> 
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
                <h3 class="card-title">Search Assign Subject</h3>
              </div>
              <form method="get" action=""> 
                <div class="card-body"> 
                  <div class="row">
                <div class="form-group col-md-3">
                    <label>Class Name</label>
                    <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Class Name">
                  </div> 
                  <div class="form-group col-md-3">
                    <label>Subject Name</label>
                    <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="date"> 
                  </div> 
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button> 
                    <a href="{{ url('admin/assign_subject/list')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Assign Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class Name</th> 
                      <th>Subject Name</th>
                      <th>Status</th> 
                      <th>Created By</th> 
                      <th>Created Date</th> 
                      <th>Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($getRecord as $value) 
                    <tr>
                        <td>{{ $value->id }}</td> 
                        <td>{{ $value->class_name }}</td> 
                        <td>{{ $value->subject_name }}</td>
                        <td>
                            @if($value->status == 0) 
                            <div class="btn btn-success">Active </div>
                            @else 
                            <div class="btn btn-danger">Inactive </div>
                            @endif 
                        </td> 
                        <td>{{ $value->created_by_name }}</td> 
                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td> 
                        <td>
                        <a href="{{ url('admin/assign_subject/edit/'.$value->id)}}" class="btn btn-primary">Edit</a> 
                        <a href="{{ url('admin/assign_subject/edit_single/'.$value->id)}}" class="btn btn-primary">Edit Single</a>
                        <a onclick="confirmation(event)" href="{{url('admin/assign_subject/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
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

  