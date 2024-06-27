@extends('layouts.app') 
@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
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
              <form method="post" action="" enctype="multipart/form-data"> 
                {{csrf_field()}} 
                <div class="card-body"> 
                    <div class="row">
                <div class="form-group col-md-6">
                    <label>Last Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('last_name', $getRecord->last_name) }}" name="last_name" required placeholder="Last Name"> 
                    <div style="color:red">{{ $errors->first('first_name') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>First Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('first_name', $getRecord->first_name) }}" name="first_name" required placeholder="First Name"> 
                    <div style="color:red">{{ $errors->first('last_name') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Gender <span style="color: red;">*</span></label> 
                    <select class="form-control" required name="gender">
                        <option value="">Select Gender</option> 
                        <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : ''}} value="Male">Male</option> 
                        <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : ''}} value="Female">Female</option> 
                        <option {{ (old('gender', $getRecord->gender) == 'Other') ? 'selected' : ''}} value="Other">Other</option>
                    </select> 
                    <div style="color:red">{{ $errors->first('gender') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Date of Birth </label> 
                    <input type="date" class="form-control" value="{{ old('date_of_birth', $getRecord->date_of_birth)}}" name="date_of_birth" required > 
                    <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Mobile Number <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('mobile_number', $getRecord->mobile_number) }}" name="mobile_number" required placeholder="Mobile Number"> 
                    <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                  </div>  
                  <div class="form-group col-md-6">
                    <label>Marital Status <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old('marital_status', $getRecord->marital_status) }}" name="marital_status" required placeholder="Last Name">
                    <div style="color:red">{{ $errors->first('marital_status') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Address <span style="color: red;">*</span></label>
                    <textarea style="resize: none;" class="form-control" required name="address">{{ old('address', $getRecord->address) }}</textarea>
                    <div style="color:red">{{ $errors->first('address') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Qualification <span style="color: red;">*</span></label>
                    <textarea style="resize: none;" class="form-control" required name="qualification">{{ old('qualification', $getRecord->qualification) }}</textarea>
                    <div style="color:red">{{ $errors->first('qualification') }}</div>
                  </div> 
                  <div class="form-group col-md-6">
                    <label>Profile Pic</label>
                    <input type="file" class="form-control" name="profile_pic"> 
                    <div style="color:red">{{ $errors->first('profile_pic') }}</div> 
                    @if(!empty($getRecord->profile_pic)) 
                    <img src="{{ asset('upload/profile/'.$getRecord->profile_pic) }}" style="width: 100px;"> 
                    @endif 
                  </div>  
                  <div class="form-group col-md-6">
                    <label>Status <span style="color: red;">*</span></label> 
                    <select class="form-control" required name="status">
                        <option value="">Select Status</option> 
                        <option {{ old('status', $getRecord->status) == 0 ? 'selected' : ''}} value="0">Active</option> 
                        <option {{ old('status', $getRecord->status) == 1 ? 'selected' : ''}} value="1">Inactive</option> 
                    </select> 
                    <div style="color:red">{{ $errors->first('status') }}</div>
                  </div> 
                   </div> 
                   <br/> 


                  <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" name="email" required placeholder="Email"> 
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password"> 
                    <p>Do you want to change password so Please add new password</p> 
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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

  