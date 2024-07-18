@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nhập điểm học viên</h1>
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
                <h3 class="card-title">Tìm kiếm</h3>
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
                    <a href="{{ url('admin/examinations/marks_register')}}" class="btn btn-success" style="margin-top: 30px;">Xóa</a>
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
                <h3 class="card-title">Nhập điểm</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
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
                        $totalStudentMark = 0; 
                        $totalFullMarks = 0; 
                        $totalPassingMark = 0; 
                        $pass_fail_vali = 0; 
                        @endphp 
                        @foreach($getSubject as $subject) 

                        @php 
                        $totalMark = 0; 
                        $totalFullMarks = $totalFullMarks + $subject->full_marks; 
                        $totalPassingMark = $totalPassingMark + $subject->passing_marks; 
                        $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id); 
                        if(!empty($getMark)){
                            $totalMark = $getMark->class_work; 
                        } 
                        $totalStudentMark = $totalStudentMark + $totalMark; 
                        @endphp 
                        <td> 
                            <div style="margin-bottom: 10px;">
                                Class work 
                                <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                                <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id}}">
                                <input type="text" name="mark[{{ $i }}][class_work]" id="class_work_{{ $student->id}}{{ $subject->subject_id}}" style="width: 200px;" placeholder="Enter Mark" value="{{ !empty($getMark->class_work) ? $getMark->class_work : ''}}" class="form-control"> 
                            </div> 
                            <div style="margin-bottom: 10px;">
                                Home work
                                <input type="text" id="test_work_{{ $student->id}}{{ $subject->subject_id}}" name="mark[{{ $i }}][test_work]" style="width:200px;" placeholder="Enter Mark" value="{{ !empty($getMark->test_work) ? $getMark->test_work : ''}}" class="form-control"> 
                            </div> 
                            <div style="margin-bottom: 10px;">
                                Exam 
                                <input type="text" id="exam_{{ $student->id}}{{ $subject->subject_id}}" name="mark[{{ $i }}][exam]" style="width:200px;" placeholder="Enter Mark" value="{{ !empty($getMark->exam) ? $getMark->exam : ''}}" class="form-control"> 
                            </div> 
                            <div style="margin-botton: 10px;">
                            <button type="button" class="btn btn-primary SaveSingleSubject" id="{{ $student->id }}" data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}" data-schedule="{{ $subject->id}}" data-class="{{ Request::get('class_id') }}">Save</button>
                            </div> 
                            @if(!empty($getMark)) 
                            <div style="margin-bottom: 10px;"> 
                            <b> Ghi chu </b> <br/>
                            <b>Tổng Điểm: </b> {{ round($totalMark, 2) }} <br/> 
                            <b>Điểm đạt: </b> {{ $subject->passing_marks }} <br/> 
                            @if($totalMark >= $subject->passing_marks) 
                            Ket qua: <span style="color: green; font-weight: bold;">Dat</span>
                            @else 
                            Ket qua: <span style="color: red; font-weight: bold;">Chua Dat</span> 
                            @php 
                            $pass_fail_vali = 1; 
                            @endphp 
                            @endif 
                            </div>
                            @endif 
                        </td> 
                        @php 
                        $i ++; 
                        @endphp 
                        @endforeach 
                        <td style="min-width: 250px;">
                            <button type="submit" class="btn btn-success">Lưu lại</button> 
                            @if(!empty($totalStudentMark))
                            <br/> 
                            <b>Điểm tổng kết </b> {{$totalStudentMark}} 
                            <br/> 
                            <b>Tổng điểm của các môn: </b> {{$totalFullMarks}} 
                            <br/> 
                            <b>Tổng điểm qua của các môn: </b> {{$totalPassingMark}} 
                            <br/> 
                            @php 
                            $percentage = ($totalStudentMark * 100) / $totalFullMarks; 
                            @endphp 
                            <br/> 
                            <b>Phần trăm: </b> {{ round($percentage, 2) }}% 
                            <br/> 
                            @if($pass_fail_vali == 0) 
                            Ket qua: <span style="color: green; font-weight: bold;">Dat</span>
                            @else 
                            Ket qua: <span style="color: red; font-weight: bold;">Chua Dat</span> 
                            @endif 
                            @endif 
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


    $('.SaveSingleSubject').click(function(e) {
        var student_id = $(this).attr('id'); 
        var subject_id = $(this).attr('data-val'); 
        var exam_id = $(this).attr('data-exam'); 
        var class_id = $(this).attr('data-class'); 
        var id = $(this).attr('data-schedule'); 
        var class_work = $('#class_work_'+student_id+subject_id).val();
       // var test_work = $('#test_work_'+student_id+subject_id).val();
       // var exam = $('#exam_'+student_id+subject_id).val(); 

        $.ajax({
            type: "POST", 
            url: "{{url('admin/examinations/single_submit_marks_register')}}", 
            data: { 
                '_token': "{{ csrf_token() }}", 
                id: id, 
                student_id: student_id, 
                subject_id: subject_id,
                exam_id: exam_id, 
                class_id: class_id, 
                class_work: class_work, 
               // test_work: test_work, 
               // exam: exam, 
            }, 
            dataType: "json", 
            success: function(data) {
                alert(data.message); 
            }, 
        }); 
    })
</script>
@endsection 

  