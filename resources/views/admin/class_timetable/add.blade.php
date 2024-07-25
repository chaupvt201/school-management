@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm lịch học mới</h1>
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
                    <label>Lớp</label>
                    <select class='form-control getClass' name="class_id" required>
                        <option value="">Chọn lớp</option> 
                            @foreach($getClass as $class) 
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                            @endforeach 
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Môn học</label>
                    <select class='form-control getSubject' name="subject_id" required>
                        <option value="">Chọn môn<option> 
                            @if(!empty($getSubject)) 
                            @foreach($getSubject as $subject) 
                            <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : ''}}
                                 value="{{ $subject->subject_id}}">{{$subject->subject_name}}</option> 
                            @endforeach 
                            @endif 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Giáo viên</label> 
                    <select class="form-control" name="teacher_id" required>
                        <option value="">Chọn giáo viên</option> 
                        @foreach($getTeacher as $teacher) 
                        <option value="{{ $teacher->id }}">{{ $teacher->last_name}} {{$teacher->first_name}}</option>
                        @endforeach 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Chọn ngày</label> 
                    <select class="form-control" name="day" required>
                        <option value="">Chọn ngày</option> 
                        <option value="Monday">Thứ hai</option> 
                        <option value="Tuesday">Thứ ba</option> 
                        <option value="Wednesday">Thứ tư</option> 
                        <option value="Thursday">Thứ năm</option> 
                        <option value="Friday">Thứ sáu</option> 
                        <option value="Saturday">Thứ bảy</option> 
                        <option value="Sunday">Chủ nhật</option>
                    </select>
                  </div> 
                  <div class="form-group"> 
                    <label>Thời gian bắt đầu</label> 
                    <input type="time" class="form-control" name="start_time" required>
                  </div> 
                  <div class="form-group">
                    <label>Thời gian kết thúc</label> 
                    <input type="time" class="form-control" name="end_time" required> 
                  </div> 
                  <div class="form-group">
                    <label>Phòng học</label> 
                    <input type="text" class="form-control" name="room_number" placeholder="Phòng học" required> 
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
@section('script') 
<script type="text/javascript">
    $('.getClass').change(function() {
        var class_id = $(this).val(); 
        $.ajax({
            url: "{{ url('admin/class_timetable/get_subject') }}", 
            type: "POST", 
            data:{
                "_token": "{{ csrf_token() }}", 
                class_id: class_id, 
            }, 
            dataType:"json", 
            success:function(response){
                $('.getSubject').html(response.html); 
            }, 
        }); 
    }); 
</script>
@endsection 
  