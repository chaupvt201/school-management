@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật lịch học</h1>
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
                            <option value="{{ $class->id}}" {{ ($class->id == $getRecord->class_id) ? 'selected': '' }}>{{ $class->name}}</option>
                            @endforeach 
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Chọn môn học</label>
                    <select class='form-control getSubject' name="subject_id" required>
                        <option value="">Chọn môn học<option> 
                            @foreach($getSubject as $subject) 
                            <option value="{{ $subject->id}}" {{ ($subject->id == $getRecord->subject_id) ? 'selected' : '' }}>{{ $subject->name}}</option>
                            @endforeach 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Giáo viên</label> 
                    <select class="form-control" name="teacher_id" required>
                        <option value="">Chọn giáo viên</option> 
                        @foreach($getTeacher as $teacher) 
                        <option value="{{ $teacher->id }}" {{ ($getRecord->teacher_id == $teacher->id) ? 'selected' : ''}}>{{ $teacher->last_name}} {{$teacher->first_name}}</option>
                        @endforeach 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Day</label> 
                    <select class="form-control" name="day" required>
                        <option value="">Chọn ngày</option> 
                        <option value="Monday" {{ ($getRecord->day == "Monday") ? 'selected' : '' }}>Thứ hai</option> 
                        <option value="Tuesday" {{ ($getRecord->day == "Tuesday") ? 'selected' : '' }}>Thứ ba</option> 
                        <option value="Wednesday" {{ ($getRecord->day == "Wednesday") ? 'selected' : '' }}>Thứ tư</option> 
                        <option value="Thursday" {{ ($getRecord->day == "Thursday") ? 'selected' : '' }}>Thứ năm</option> 
                        <option value="Friday" {{ ($getRecord->day == "Friday") ? 'selected' : ''}}>Thứ sáu</option> 
                        <option value="Saturday" {{ ($getRecord->day == "Saturday") ? 'selected' : ''}}>Thứ bảy</option> 
                        <option value="Sunday" {{ ($getRecord->day == "Sunday") ? 'selected' : ''}}>Chủ nhật</option>
                    </select>
                  </div> 
                  <div class="form-group"> 
                    <label>Thời gian bắt đầu</label> 
                    <input type="time" class="form-control" name="start_time" value="{{ $getRecord->start_time}}" required>
                  </div> 
                  <div class="form-group">
                    <label>Thời gian kết thúc</label> 
                    <input type="time" class="form-control" name="end_time" value="{{ $getRecord->end_time}}" required> 
                  </div> 
                  <div class="form-group">
                    <label>Phòng học</label> 
                    <input type="text" class="form-control" name="room_number" value="{{ $getRecord->room_number}}" placeholder="Phòng học" required> 
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
  