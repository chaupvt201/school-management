@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lịch thi </h1>
          </div> 
          <div class="col-sm-6" style="text-align: right;"> 
          <a href="{{ url('admin/examinations/exam/add')}}" class="btn btn-primary">Thêm mới lịch thi</a> 
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
                <h3 class="card-title">Tìm kiếm lịch thi</h3>
              </div>
              <form method="get" action=""> 
                <div class="card-body"> 
                  <div class="row">
                <div class="form-group col-md-3">
                    <label>Tên kỳ thi</label>
                    <select class="form-control" name="exam_id" required>
                    <option value="">Select</option> 
                    @foreach($getExam as $exam) 
                    <option {{(Request::get('exam_id') == $exam->id) ? 'selected': '' }} value="{{ $exam->id}}">{{ $exam->name}}</option>
                    @endforeach 
                    </select>
                  </div> 
                  <div class="form-group col-md-3">
                    <label>Tên lớp</label> 
                    <select class="form-control" name="class_id" required>
                        <option value="">Select</option> 
                        @foreach($getClass as $class) 
                        <option {{ (Request::get('class_id') == $class->id) ? 'selected': ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                        @endforeach 
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Tìm kiếm</button> 
                    <a href="{{ url('admin/examinations/exam_schedule')}}" class="btn btn-success" style="margin-top: 30px;">Xóa</a>
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

            @if(!empty($getRecord)) 
            <form action="{{ url('admin/examinations/exam_schedule_insert')}}" method="post"> 
                {{csrf_field()}} 
                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id')}}"> 
                <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Danh sách kỳ thi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Tên môn thi</th>
                      <th>Ngày thi</th>
                      <th>Thời gian bắt đầu</th>
                      <th>Thời gian kết thúc</th> 
                      <th>Phòng thi</th> 
                      <th>Điểm tối đa</th> 
                      <th>Điểm đạt tối thiểu</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @php 
                    $i = 1; 
                    @endphp 
                    @foreach($getRecord as $value) 
                    <tr>
                        <td>{{ $value['subject_name']}}
                            <input type="hidden" class="form-control" value="{{$value['subject_id']}}" name="schedule[{{$i}}][subject_id]">
                        </td> 
                        <td>
                            <input type="date" class="form-control" value="{{$value['exam_date']}}" name="schedule[{{$i}}][exam_date]">
                        </td> 
                        <td>
                            <input type="time" class="form-control" value="{{$value['start_time']}}" name="schedule[{{$i}}][start_time]">
                        </td> 
                        <td>
                            <input type="time" class="form-control" value="{{$value['end_time']}}"name="schedule[{{$i}}][end_time]" >
                        </td> 
                        <td>
                            <input type="type" class="form-control"value="{{$value['room_number']}}"  name="schedule[{{$i}}][room_number]">
                        </td> 
                        <td>
                            <input type="type" class="form-control" value="{{$value['full_marks']}}" name="schedule[{{$i}}][full_marks]">
                        </td> 
                        <td>
                            <input type="type" class="form-control"value="{{$value['passing_marks']}}"  name="schedule[{{$i}}][passing_marks]">
                        </td> 
                    </tr> 
                    @php 
                    $i++; 
                    @endphp 
                    @endforeach 
                  </tbody>
                </table> 
                <div style="text-align: center; padding: 20px;">
                <button class="btn btn-success">Cập nhật</button>
                </div>
              </div>
              <!-- /.card-body -->
            </div> 
            </form> 
            @endif 
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

  