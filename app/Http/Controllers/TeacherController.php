<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\User; 
use App\Models\Teacher; 
use App\Exports\ExportTeacher; 
use Hash; 
use Str; 
use Illuminate\Support\Facades\DB; 
use Excel; 

class TeacherController extends Controller
{ 
    public function export_excel(Request $request){
        return Excel::download(new ExportTeacher, 'Teacher_'.date('d-m-Y').'.xls'); 
    }
    public function list(){
        $data['getRecord'] = User::getTeacher(); 
        $data['header_title'] = 'Danh sách giáo viên'; 
        return view('admin.teacher.list', $data); 
    } 
    public function add(){
        $data['header_title'] = 'Thêm giáo viên'; 
        return view('admin.teacher.add'); 
    } 
    public function insert(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users', 
            'mobile_number' => 'max:15|min:8'
        ],[
            'email.required' => 'Please enter your email', 
            'email.unique' => 'Tài khoản email đã tồn tại Vui lòng nhập địa chỉ email mới', 
        ]); 
        $user = new User; 
        $user->email = trim($request->email); 
        $user->password = Hash::make($request->password); 
        $user->user_type = 2; 
        $user->save(); 
        $id = $user->id; 
        $teacher = new Teacher; 
        $teacher->first_name = trim($request->first_name); 
        $teacher->last_name = trim($request->last_name); 
        $teacher->user_id = $id; 
        $teacher->gender = trim($request->gender); 
        $teacher->date_of_birth = trim($request->date_of_birth); 
        $teacher->mobile_number = trim($request->mobile_number); 
        if(!empty($request->file('profile_pic'))){
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
        $teacher->status = trim($request->status); 
        $teacher->save(); 
        return redirect('admin/teacher/list')->with('success', 'Thêm mới giáo viên thành công'); 
    } 
    public function edit($id){
        $data['getRecord'] = DB::table('users')
                                 ->join('teacher', 'teacher.user_id', 'users.id')
                                 ->where('users.id', $id)
                                 ->select('users.*', 'teacher.*')->first(); 
        if(!empty($data['getRecord'])){
        $data['header_title'] = "Cập nhật giáo viên"; 
        return view('admin.teacher.edit', $data); 
        } 
        else{
            abort(404); 
        }
    } 
    public function update($id, Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id, 
            'mobile_number' => 'max:15|min:8'
        ],[
            'email.required' => 'Please enter your email', 
            'email.unique' => 'Tài khoản email đã tồn tại Vui lòng nhập địa chỉ email khác', 
        ]);  
        $user = User::find($id); 
        $user->email = trim($request->email); 
        if(!empty($request->password)){
            $user->password = Hash::make($request->password); 
        } 
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
        $teacher->status = trim($request->status); 
        $teacher->save(); 
        return redirect('admin/teacher/list')->with('success', 'Cập nhật giáo viên thành công'); 
    } 
    public function delete($id){
        $teacher = Teacher::where('user_id', $id)->first(); 
        if(!empty($teacher->getProfile())){
            unlink('upload/profile/'.$teacher->profile_pic); 
        } 
        $teacher->delete(); 
        $user = User::getSingle($id); 
        $user->delete(); 
        return redirect()->back()->with('success', 'Xóa giáo viên thành công'); 
    }
}
