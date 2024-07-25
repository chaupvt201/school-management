@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật môn học</h1>
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
                    <label>Tên môn</label>
                    <input type="text" class="form-control" name="name" value="{{$getRecord->name}}" required placeholder="Class Name">
                  </div> 
                  <div class="form-group">
                    <label>Loại môn</label>
                    <select class="form-control" name="type" required> 
                        <option value="">Loại môn</option>
                        <option {{ ($getRecord->type == 'Theory') ? 'selected' : ''}} value="Theory">Lý thuyết</option> 
                        <option {{ ($getRecord->type == 'Practical') ? 'selected' : ''}} value="Practical">Thực hành</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status">
                        <option {{ ($getRecord->status == 0) ? 'selected' : ''}} value="0">Kích hoạt</option> 
                        <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Không kích hoạt</option>
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

  