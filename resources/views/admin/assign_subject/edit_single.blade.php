@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật đăng ký môn</h1>
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
                    <select class="form-control" name="class_id" required> 
                        <option value= "">Chọn lớp</option>
                        @foreach($getClass as $class) 
                        <option {{ ($getRecord->class_id == $class->id) ? 'selected' : ''}} value="{{ $class->id}}">{{ $class->name }}</option>
                        @endforeach 
                    </select>
                  </div> 
                  
                <div class="form-group">
                    <label>Môn học</label>
                    <select class="form-control" name="subject_id" required> 
                        <option value= "">Chọn môn học</option>
                        @foreach($getSubject as $subject) 
                        <option {{ ($getRecord->subject_id == $subject->id) ? 'selected' : ''}} value="{{ $subject->id}}">{{ $subject->name }}</option>
                        @endforeach 
                    </select>
                  </div> 

                  


                  
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status">
                        <option {{ ($getRecord->status == 0) ? 'selected' : ''}} value="0">Kích hoạt</option> 
                        <option {{ ($getRecord->status == 1) ? 'selected' : ''}} value="1">Không kích hoạt</option>
                    </select>
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

  