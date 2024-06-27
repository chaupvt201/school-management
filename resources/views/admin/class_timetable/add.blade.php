@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Class</h1>
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
                    <label>Class Name</label>
                    <select class='form-control getClass' name="class_id" required>
                        <option value="">Select Class</option> 
                            @foreach($getClass as $class) 
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                            @endforeach 
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    <select class='form-control getSubject' name="subject_id" required>
                        <option value="">Select Subject<option> 
                            @if(!empty($getSubject)) 
                            @foreach($getSubject as $subject) 
                            <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : ''}}
                                 value="{{ $subject->subject_id}}">{{$subject->subject_name}}</option> 
                            @endforeach 
                            @endif 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Teacher</label> 
                    <select class="form-control" name="teacher_id" required>
                        <option value="">Select Teacher</option> 
                        @foreach($getTeacher as $teacher) 
                        <option value="{{ $teacher->id }}">{{ $teacher->last_name}} {{$teacher->first_name}}</option>
                        @endforeach 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Day</label> 
                    <select class="form-control" name="day" required>
                        <option value="">Select Day</option> 
                        <option value="Monday">Monday</option> 
                        <option value="Tuesday">Tuesday</option> 
                        <option value="Wednesday">Wednesday</option> 
                        <option value="Thursday">Thursday</option> 
                        <option value="Friday">Friday</option> 
                        <option value="Saturday">Saturday</option> 
                        <option value="Sunday">Sunday</option>
                    </select>
                  </div> 
                  <div class="form-group"> 
                    <label>Start Time</label> 
                    <input type="time" class="form-control" name="start_time" required>
                  </div> 
                  <div class="form-group">
                    <label>End Time</label> 
                    <input type="time" class="form-control" name="end_time" required> 
                  </div> 
                  <div class="form-group">
                    <label>Room Number</label> 
                    <input type="text" class="form-control" name="room_number" placeholder="room number" required> 
                  </div>
                  
                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
  