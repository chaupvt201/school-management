@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class Timetable</h1>
          </div> 
          <div class="col-sm-6" style="text-align: right;"> 
          <a href="{{ url('admin/class_timetable/add')}}" class="btn btn-primary">Add New Class Timetable</a> 
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
                <h3 class="card-title">Search Assign Subject</h3>
              </div>
              <form method="get" action=""> 
                <div class="card-body"> 
                  <div class="row">
                <div class="form-group col-md-3">
                    <label>Class Name</label>
                    <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Class Name">
                  </div> 
                  <div class="form-group col-md-3">
                    <label>Subject Name</label>
                    <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject Name">
                  </div>

                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button> 
                    <a href="{{ url('admin/assign_subject/list')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Assign Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped table-bordered table-centered mb-0">
                  <tbody>
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thu Hai</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Monday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
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
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/edit', $value->id) }}" >Edit</a> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/delete', $value->id) }}">Delete</a>
                        </div> 
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thu Ba</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Tuesday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
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
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/edit', $value->id) }}" >Edit</a> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/delete', $value->id) }}">Delete</a>
                        </div> 
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thu Tu</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Wednesday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
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
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/edit', $value->id) }}" >Edit</a> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/delete', $value->id) }}">Delete</a>
                        </div> 
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thu Nam</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Thursday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
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
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/edit', $value->id) }}" >Edit</a> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/delete', $value->id) }}">Delete</a>
                        </div> 
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thu Sau</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Friday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
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
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/edit', $value->id) }}" >Edit</a> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/delete', $value->id) }}">Delete</a>
                        </div> 
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Thu Bay</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Saturday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
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
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/edit', $value->id) }}" >Edit</a> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/delete', $value->id) }}">Delete</a>
                        </div> 
                        </div> 
                        @endif 
                        @endforeach 
                        </td>
                    </tr> 
                    <tr>
                      <td style="font-weight: bold; width: 100px;">Chu nhat</td>
                      <td class="m-1"> 
                        @foreach($getRecord as $value) 
                        @if($value->day == "Sunday")
                        <div class="btn-group text-start">
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> 
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
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/edit', $value->id) }}" >Edit</a> 
                            <a class="dropdown-item" href="{{ url('admin/class_timetable/delete', $value->id) }}">Delete</a>
                        </div> 
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

  