@extends('layouts.app') 
@section('style') 
<style type="text/css">
  .fc-daygrid-event {
    white-space: normal; 
  }
</style>
@endsection 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
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
            <div id="calendar"></div>
            @include('message') 
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>



 @endsection 
 
@section('script') 
<script src="{{ asset('dist/fullcalendar/index.global.js') }}"></script> 

<script type="text/javascript"> 
    var events = new Array(); 

    @foreach($getClassTimetable as $value) 
    events.push({
      title: 'Lớp: {{ $value['class_name'] }} - {{ $value['name'] }}', 
      daysOfWeek: [{{ $value['fullcalendar'] }}], 
      startTime: '{{ $value['start_time'] }}', 
      endTime: '{{ $value['end_time']}}', 
    }); 
    @endforeach 

    @foreach($getExamTimetable as $exam) 
    events.push({
      title: 'Kiểm tra: {{ $exam->class_name }} - {{ $exam->exam_name }} - {{ $exam->subject_name }} ({{ date('h:i A', strtotime($exam->start_time))}} to {{ date('h:i A', strtotime($exam->end_time))}})', 
      start: '{{ $exam->exam_date }}', 
      end: '{{ $exam->exam_date }}', 
      color: 'green',
      url: '{{ url('teacher/my_exam_timetable') }}', 
    })
    @endforeach 
    var calendarID = document.getElementById('calendar'); 
    var calendar = new FullCalendar.Calendar(calendarID, {
        headerToolbar: {
            left: 'prev,next today', 
            center: 'title', 
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        }, 
        initialDate: '<?=date('Y-m-d')?>', 
        navLinks: true, 
        editable: false, 
        events: events, 
        initialView: 'dayGridMonth', 
    }); 
    calendar.render(); 
</script>
@endsection

  