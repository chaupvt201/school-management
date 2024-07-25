<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\User; 
use App\Models\Teacher; 
use App\Models\Student; 
use App\Models\Admin; 
use Auth; 
use Hash; 
use Illuminate\Support\Facades\DB; 

class UserController extends Controller
{ 
    public function MyAccount(){ 
        if(Auth::user()->user_type == 1){
            $data['getRecord'] = DB::table('users')
                                    ->join('admin', 'admin.user_id', 'users.id')
                                    ->where('users.id', Auth::user()->id) 
                                    ->select('users.*', 'admin.admin_name')
                                    ->first(); 
        $data['header'] = "Cập nhật tài khoản"; 
        return view('admin.my_account', $data); 
        }
        elseif(Auth::user()->user_type == 2){
        $data['getRecord'] = DB::table('users')
                                ->join('teacher', 'teacher.user_id', 'users.id')
                                ->where('users.id', Auth::user()->id) 
                                ->first(); 
        $data['header_title'] = "Cập nhật tài khoản"; 
        return view('teacher.my_account', $data); 
        } 
        elseif(Auth::user()->user_type == 3){
            $data['getRecord'] = DB::table('users')
                                ->join('student', 'student.user_id', 'users.id')
                                ->where('users.id', Auth::user()->id) 
                                ->first(); 
        $data['header_title'] = "Cập nhật tài khoản"; 
        return view('student.my_account', $data); 
        }
    } 
    public function UpdateMyAccountAdmin(Request $request){
        $id = Auth::user()->id; 
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ],[
            'email.unique' => 'Tài khoản email đã tồn tại Vui lòng nhập email khác'
        ]); 
        $user = User::find($id); 
        $user->email = trim($request->email); 
        $user->save(); 
        $admin = Admin::where('user_id', $id)->first(); 
        $admin->admin_name = trim($request->name); 
        $admin->save(); 
        return redirect()->back()->with('success', 'Cập nhật tài khoản thành công'); 


    }
    public function UpdateMyAccount(Request $request){ 
        $id = Auth::user()->id; 
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id, 
            'mobile_number' => 'max:15|min:8'
        ],[
            'email.required' => 'Please enter your email', 
            'email.unique' => 'Tài khoản email đã tồn tại Vui lòng nhập email khác', 
        ]);  
        $user = User::find($id); 
        $user->email = trim($request->email); 
        $user->save(); 
        $teacher = Teacher::where('user_id', $id)->first(); 
        $teacher->first_name = trim($request->first_name); 
        $teacher->last_name = trim($request->last_name); 
        $teacher->gender = trim($request->gender); 
        $teacher->date_of_birth = trim($request->date_of_birth); 
        $teacher->mobile_number = trim($request->mobile_number); 
        if(!empty($request->file('profile_pic'))){ 
            if(!empty($teacher->getProfile())){
                unlink('upload/profile/'.$teacher->profile_pic); 
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension(); 
            $file = $request->file('profile_pic'); 
            $randomStr = date('Ymdhis').Str::random(20); 
            $filename = strtolower($randomStr).'.'.$ext; 
            $file->move('upload/profile/', $filename); 
            $teacher->profile_pic = $filename; 
        } 
        $teacher->marital_status = trim($request->marital_status); 
        $teacher->address = trim($request->address); 
        $teacher->qualification = trim($request->qualification); 
        $teacher->save(); 
        return redirect()->back()->with('success', 'Cập nhật tài khoản thành công'); 
    } 
    public function UpdateMyAccountStudent(Request $request){ 
        $id = Auth::user()->id; 
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id, 
            'mobile_number' => 'max:15|min:8'
        ],[
            'email.required' => 'Please enter your email', 
            'email.unique' => 'Tài khoản email đã tồn tại Vui lòng nhập email khác', 
        ]); 
        $user = User::find($id); 
        $user->email = trim($request->email); 
        $user->save(); 
        $student = Student::where('user_id', $id)->first(); 
        $student->first_name = trim($request->first_name); 
        $student->last_name = trim($request->last_name); 
        $student->gender = trim($request->gender); 
        $student->date_of_birth = trim($request->date_of_birth); 
        $student->mobile_number = trim($request->mobile_number); 
        if(!empty($request->file('profile_pic'))){ 
            if(!empty($student->getProfile())){
                unlink('upload/profile/'.$student->profile_pic); 
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension(); 
            $file = $request->file('profile_pic'); 
            $randomStr = date('Ymdhis').Str::random(20); 
            $filename = strtolower($randomStr).'.'.$ext; 
            $file->move('upload/profile/', $filename); 
            $student->profile_pic = $filename; 
        } 
        $student->save(); 
        return redirect()->back()->with('success', 'Cập nhật tài khoản thành công'); 
    }
    public function change_password(){
        $data['header_title'] = "Chang Password"; 
        return view('profile.change_password', $data); 
    } 
    public function update_change_password(Request $request){
        $user = User::getSingle(Auth::user()->id); 
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password); 
            $user->save(); 
            return redirect()->back()->with('success', 'Cập nhật mật khẩu thành công'); 
        }else{
            return redirect()->back()->with('error', 'Mật khẩu cũ chưa chính xác'); 
        }
    }
}
