@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thời khóa biểu</h1>
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


          
            
            
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
            @include('message')
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Thời khóa biểu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped table-bordered table-centered mb-0">
                  <tbody>
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thứ hai</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Monday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-book"></i>
                            {{ $value->subject_name}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-alarm"></i>
                            {{ $value->start_time}} - {{ $value->end_time}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-person"></i>
                            {{ $value->teacher_lastname}} {{ $value->teacher_firstname}}
                            </p> 
                            <p class="margin-bottom: 0px;"><i class="bi bi-house-add"></i>
                            {{ $value->room_number}}
                            </p> 
                            <span class="caret"></span> 
                          </button>  
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thứ ba</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Tuesday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-book"></i>
                            {{ $value->subject_name}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-alarm"></i>
                            {{ $value->start_time}} - {{ $value->end_time}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-person"></i>
                            {{ $value->teacher_lastname}} {{ $value->teacher_firstname}}
                            </p> 
                            <p class="margin-bottom: 0px;"><i class="bi bi-house-add"></i>
                            {{ $value->room_number}}
                            </p> 
                            <span class="caret"></span> 
                          </button>  
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thứ tư</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Wednesday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-book"></i>
                            {{ $value->subject_name}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-alarm"></i>
                            {{ $value->start_time}} - {{ $value->end_time}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-person"></i>
                            {{ $value->teacher_lastname}} {{ $value->teacher_firstname}}
                            </p> 
                            <p class="margin-bottom: 0px;"><i class="bi bi-house-add"></i>
                            {{ $value->room_number}}
                            </p> 
                            <span class="caret"></span> 
                          </button>  
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thứ năm</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Thursday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-book"></i>
                            {{ $value->subject_name}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-alarm"></i>
                            {{ $value->start_time}} - {{ $value->end_time}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-person"></i>
                            {{ $value->teacher_lastname}} {{ $value->teacher_firstname}}
                            </p> 
                            <p class="margin-bottom: 0px;"><i class="bi bi-house-add"></i>
                            {{ $value->room_number}}
                            </p> 
                            <span class="caret"></span> 
                          </button>  
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thứ sáu</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Friday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-book"></i>
                            {{ $value->subject_name}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-alarm"></i>
                            {{ $value->start_time}} - {{ $value->end_time}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-person"></i>
                            {{ $value->teacher_lastname}} {{ $value->teacher_firstname}}
                            </p> 
                            <p class="margin-bottom: 0px;"><i class="bi bi-house-add"></i>
                            {{ $value->room_number}}
                            </p> 
                            <span class="caret"></span> 
                          </button>  
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thứ bảy</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Saturday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-book"></i>
                            {{ $value->subject_name}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-alarm"></i>
                            {{ $value->start_time}} - {{ $value->end_time}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-person"></i>
                            {{ $value->teacher_lastname}} {{ $value->teacher_firstname}}
                            </p> 
                            <p class="margin-bottom: 0px;"><i class="bi bi-house-add"></i>
                            {{ $value->room_number}}
                            </p> 
                            <span class="caret"></span> 
                          </button>   
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Chủ nhật</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Sunday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-book"></i>
                            {{ $value->subject_name}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-alarm"></i>
                            {{ $value->start_time}} - {{ $value->end_time}}
                            </p> 
                            <p style="margin-bottom: 0px;"><i class="bi bi-person"></i>
                            {{ $value->teacher_lastname}} {{ $value->teacher_firstname}}
                            </p> 
                            <p class="margin-bottom: 0px;"><i class="bi bi-house-add"></i>
                            {{ $value->room_number}}
                            </p> 
                            <span class="caret"></span> 
                          </button>  
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                  </tbody>
                </table>
                
              </div>
              </div>
              <!-- /.card-body -->
            </div>
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

  