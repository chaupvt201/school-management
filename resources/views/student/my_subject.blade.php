@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Môn học của tôi</h1>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12"> 


          
                  
                  

                <!-- /.card-body -->

                
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
                <h3 class="card-title">Danh sách môn học</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Môn học</th> 
                      <th>Loại môn</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value) 
                    <tr>
                        <td>{{$value->subject_name}}</td>
                        <td>{{ ($value->subject_type == 'Theory') ? 'Lý thuyết' : 'Thực hành'}}</td>
                        
                    </tr> 
                    @endforeach 
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

  