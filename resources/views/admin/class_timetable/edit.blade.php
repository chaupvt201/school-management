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
                            <option value="{{ $class->id}}" {{ ($class->id == $getRecord->class_id) ? 'selected': '' }}>{{ $class->name}}</option>
                            @endforeach 
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    <select class='form-control getSubject' name="subject_id" required>
                        <option value="">Select Subject<option> 
                            @foreach($getSubject as $subject) 
                            <option value="{{ $subject->id}}" {{ ($subject->id == $getRecord->subject_id) ? 'selected' : '' }}>{{ $subject->name}}</option>
                            @endforeach 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Teacher</label> 
                    <select class="form-control" name="teacher_id" required>
                        <option value="">Select Teacher</option> 
                        @foreach($getTeacher as $teacher) 
                        <option value="{{ $teacher->id }}" {{ ($getRecord->teacher_id == $teacher->id) ? 'selected' : ''}}>{{ $teacher->last_name}} {{$teacher->first_name}}</option>
                        @endforeach 
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Day</label> 
                    <select class="form-control" name="day" required>
                        <option value="">Select Day</option> 
                        <option value="Monday" {{ ($getRecord->day == "Monday") ? 'selected' : '' }}>Monday</option> 
                        <option value="Tuesday" {{ ($getRecord->day == "Tuesday") ? 'selected' : '' }}>Tuesday</option> 
                        <option value="Wednesday" {{ ($getRecord->day == "Wednesday") ? 'selected' : '' }}>Wednesday</option> 
                        <option value="Thursday" {{ ($getRecord->day == "Thursday") ? 'selected' : '' }}>Thursday</option> 
                        <option value="Friday" {{ ($getRecord->day == "Friday") ? 'selected' : ''}}>Friday</option> 
                        <option value="Saturday" {{ ($getRecord->day == "Saturday") ? 'selected' : ''}}>Saturday</option> 
                        <option value="Sunday" {{ ($getRecord->day == "Sunday") ? 'selected' : ''}}>Sunday</option>
                    </select>
                  </div> 
                  <div class="form-group"> 
                    <label>Start Time</label> 
                    <input type="time" class="form-control" name="start_time" value="{{ $getRecord->start_time}}" required>
                  </div> 
                  <div class="form-group">
                    <label>End Time</label> 
                    <input type="time" class="form-control" name="end_time" value="{{ $getRecord->end_time}}" required> 
                  </div> 
                  <div class="form-group">
                    <label>Room Number</label> 
                    <input type="text" class="form-control" name="room_number" value="{{ $getRecord->room_number}}" placeholder="room number" required> 
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
  