<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\User; 
use App\Models\Student; 
use App\Models\ClassModel; 
use Hash; 
use Str; 
use Illuminate\Support\Facades\DB; 
use Auth; 

class StudentController extends Controller
{
    public function list(){
        $data['getRecord'] = User::getStudent(); 
        $data['header_title'] = "Student List"; 
        return view('admin.student.list', $data); 
    } 
    public function add(){ 
        $data['getClass'] = ClassModel::getClass(); 
        $data['header_title'] = 'Add Student'; 
        return view('admin.student.add', $data); 
    } 
    public function insert(Request $request){ 
        $request->validate([
            'email' => 'required|email|unique:users', 
            'mobile_number' => 'max:15|min:8'
        ],[
            'email.required' => 'Please enter your email', 
            'email.unique' => 'Please use another email', 
        ]); 
        $user = new User; 
        $user->email = trim($request->email); 
        $user->password = Hash::make($request->password); 
        $user->user_type = 3; 
        $user->save(); 
        $id = $user->id; 
        $student = new Student; 
        $student->first_name = trim($request->first_name); 
        $student->last_name = trim($request->last_name); 
        $student->user_id = $id; 
        $student->class_id = trim($request->class_id); 
        $student->gender = trim($request->gender); 
        if(!empty($request->date_of_birth)){
        $student->date_of_birth = trim($request->date_of_birth); 
        } 
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension(); 
            $file = $request->file('profile_pic'); 
            $randomStr = date('Ymdhis').Str::random(20); 
            $filename = strtolower($randomStr).'.'.$ext; 
            $file->move('upload/profile/', $filename); 
            $student->profile_pic = $filename; 
        }
        $student->mobile_number = trim($request->mobile_number); 
        $student->status = trim($request->status); 
        $student->save(); 
        
        return redirect('admin/student/list')->with('success', 'Student Addes Successfully'); 

    } 
    public function edit($id){
       // $data['getRecord'] = User::getSingle($id); 
       $data['getRecord'] = DB::table('users')->join('student', 'student.user_id', '=', 'users.id')->where('users.id', $id)->select('users.*', 'student.*')->first(); 
        if(!empty($data['getRecord'])){
            $data['getClass'] = ClassModel::getClass(); 
            $data['header_title'] = "Edit Student"; 
            return view('admin.student.edit', $data); 
        }else{
            abort(404); 
        }
    } 
    public function update($id, Request $request){ 
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id, 
            'mobile_number' => 'max:15|min:8'
        ],[
            'email.required' => 'Please enter your email', 
            'email.unique' => 'Please use another email', 
        ]); 
        $user = User::find($id); 
        $user->email = trim($request->email); 
        if(!empty($request->password)){
            $user->password = Hash::make($request->password); 
        } 
        $user->save(); 
        $student = Student::where('user_id', $id)->first(); 
        $student->first_name = trim($request->first_name); 
        $student->last_name = trim($request->last_name); 
        $student->class_id = trim($request->class_id); 
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
        $student->status = trim($request->status); 
        $student->save(); 

         
        return redirect('admin/student/list')->with('success', 'Student Updated Successfully'); 
    } 
    public function delete($id){
        $student = Student::where('user_id', $id)->first(); 
        if(!empty($student->getProfile())){
            unlink('upload/profile/'.$student->profile_pic); 
        } 
        $student->delete(); 
        $user = User::getSingle($id); 
        $user->delete(); 
        return redirect()->back()->with('success', 'Student Deleted Sucessfuly'); 
    } 
    // teacher work side 
    public function MyStudent(){ 
        $teacher_id = DB::table('teacher')->where('user_id', '=', Auth::user()->id)->value('id'); 
        $data['getRecord'] = Student::getTeacherStudent($teacher_id);
        $data['header_title'] = 'My Student List'; 
        return view('teacher.my_student', $data); 
    }
}
