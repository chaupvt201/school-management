@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kết quả</h1>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row"> 
          @foreach($getRecord as $value)
          <div class="col-md-12"> 

                
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
                <h3 class="card-title">{{ $value['exam_name']}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Môn thi</th> 
                      <th>Điểm thi</th> 
                      <th>Điểm tối đa</th> 
                      <th>Điểm đạt </th> 
                      <th>Kết quả</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @php 
                    $total_score = 0; 
                    $full_marks = 0; 
                    $result_validation = 0;
                    @endphp 
                    @foreach($value['subject'] as $exam) 
                    @php 
                    $total_score = $total_score + $exam['class_work']; 
                    $full_marks = $full_marks + $exam['full_marks']; 
                    @endphp 
                    <tr>
                      <td>{{ $exam['subject_name']}}</td> 
                      <td>{{ $exam['class_work']}}</td> 
                      <td>{{ $exam['full_marks']}}</td> 
                      <td>{{ $exam['passing_marks']}}</td> 
                      <td>
                        @if($exam['class_work'] >= $exam['passing_marks']) 
                        <span style="color: green; font-weight: bold;">Đạt</span>
                        @else 
                        @php 
                        $result_validation = 1; 
                        @endphp
                        <span style="color: red; font-weight: bold;">Chưa đạt</span>
                        @endif 
                      </td>
                    </tr>
                    @endforeach 
                    <tr>
                      <td colspan="2">
                        <b>Tổng điểm: {{ $total_score}}/{{ $full_marks}}</b>
                      </td> 
                      <td colspan="2">
                        <b>Phần trăm: {{round(($total_score *100)/ $full_marks,2)}}% </b>
                      </td> 
                      <td colspan="5">
                        <b>Kết quả: @if($result_validation == 0) 
                                       <span style="color: green;">Hoàn thành</span>
                                    @else 
                                    <span style="color: red;">Chưa hoàn thành</span> 
                                    @endif
                        </b>
                      </td>
                    </tr>
                  </tbody>
                </table> 
                <div style="padding: 10px; float: right;"> 
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> 
        @endforeach 
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

  