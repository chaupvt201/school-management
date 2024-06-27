@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Marks Register </h1>
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
                <h3 class="card-title">Search Marks Register</h3>
              </div>
              <form method="get" action=""> 
                <div class="card-body"> 
                  <div class="row">
                <div class="form-group col-md-3">
                    <label>Exam Name</label>
                    <select class="form-control" name="exam_id" required>
                    <option value="">Select</option> 
                    @foreach($getExam as $exam) 
                    <option {{(Request::get('exam_id') == $exam->id) ? 'selected': '' }} value="{{ $exam->id}}">{{ $exam->name}}</option>
                    @endforeach 
                    </select>
                  </div> 
                  <div class="form-group col-md-3">
                    <label>Class</label> 
                    <select class="form-control" name="class_id" required>
                        <option value="">Select</option> 
                        @foreach($getClass as $class) 
                        <option {{ (Request::get('class_id') == $class->id) ? 'selected': ''}} value="{{ $class->id}}">{{ $class->name}}</option>
                        @endforeach 
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button> 
                    <a href="{{ url('admin/examinations/marks_register')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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

            @if(!empty($getSubject) && !empty($getSubject->count()))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Marks Register</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Student Name</th> 
                      @foreach($getSubject as $subject)
                      <th>{{ $subject->subject_name }} <br/> 
                      ({{ $subject->subject_type}} : {{ $subject->passing_marks}} / {{$subject->full_marks}})
                      </th>
                      @endforeach 
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @if(!empty($getStudent) && !empty($getStudent->count()))
                    @foreach($getStudent as $student) 
                    <form method="post" class="SubmitForm"> 
                        {{csrf_field()}} 
                        <input type="hidden" name="student_id" value="{{ $student->id}}"> 
                        <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}"> 
                        <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}"> 
                    <tr>
                        <td>{{ $student->last_name }} {{ $student->first_name}}</td> 
                        @php 
                        $i = 1; 
                        @endphp 
                        @foreach($getSubject as $subject) 

                        @php 
                        $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id); 
                        @endphp 
                        <td> 
                            <div style="margin-bottom: 10px;">
                                Class work 
                                <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id}}">
                                <input type="text" name="mark[{{ $i }}][class_work]" style="width: 200px;" placeholder="Enter Mark" value="{{ !empty($getMark->class_work) ? $getMark->class_work : ''}}" class="form-control"> 
                            </div> 
                            <div style="margin-bottom: 10px;">
                                Home work
                                <input type="text" name="mark[{{ $i }}][test_work]" style="width:200px;" placeholder="Enter Mark" value="{{ !empty($getMark->test_work) ? $getMark->test_work : ''}}" class="form-control"> 
                            </div> 
                            <div style="margin-bottom: 10px;">
                                Exam 
                                <input type="text" name="mark[{{ $i }}][exam]" style="width:200px;" placeholder="Enter Mark" value="{{ !empty($getMark->exam) ? $getMark->exam : ''}}" class="form-control"> 
                            </div>
                        </td> 
                        @php 
                        $i ++; 
                        @endphp 
                        @endforeach 
                        <td>
                            <button type="submit" class="btn btn-success">Save</button> 
                        </td>
                    </tr> 
                    </form>
                    @endforeach 
                    @endif 
                  </tbody>
                </table> 
              </div>
              <!-- /.card-body -->
            </div> 
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
@section('script') 
<script type="text/javascript">
    $('.SubmitForm').submit(function(e) {
        e.preventDefault(); 
        $.ajax({
            type: "POST", 
            url: "{{url('admin/examinations/submit_marks_register')}}", 
            data: $(this).serialize(), 
            dataType: "json", 
            success: function(data) {
                alert(data.message); 
            }, 
        }); 
    }); 
</script>
@endsection 

  