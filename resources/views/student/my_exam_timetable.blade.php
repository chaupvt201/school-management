@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lịch kiểm tra </h1>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12"> 


          
                  
                  

                <!-- /.card-body -->

                
            </div>
            
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
            @include('message')
            <!-- /.card -->

            @foreach($getRecord as $value)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$value['name']}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Môn thi</th> 
                      <th>Ngày thi</th> 
                      <th>Thời gian bắt đầu</th> 
                      <th>Thời gian kết thúc</th> 
                      <th>Phòng thi</th> 
                      <th>Điểm tối đa</th> 
                      <th>Điểm đạt tối thiểu</th> 
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach($value['exam'] as $valueS)
                    <tr>
                        <td>{{ $valueS['subject_name']}}</td> 
                        <td>{{ date('d-m-Y', strtotime($valueS['exam_date']))}}</td> 
                        <td>{{ date('h:i A', strtotime($valueS['start_time']))}}</td> 
                        <td>{{ date('h:i A', strtotime($valueS['end_time']))}}</td> 
                        <td>{{ $valueS['room_number']}}</td> 
                        <td>{{ $valueS['full_marks']}}</td> 
                        <td>{{ $valueS['passing_marks']}}</td>
                    </tr> 
                    @endforeach 
                  </tbody>
                </table> 
                <div style="padding: 10px; float: right;"> 
                </div>
              </div> 
              <!-- /.card-body -->
            </div> 
            @endforeach 
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

  