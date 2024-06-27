<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\ClassModel; 
use App\Models\ClassSubjectModel; 
use App\Models\Teacher; 
use App\Models\ClassTimetableModel; 
use App\Models\SubjectModel; 
use Illuminate\Support\Facades\DB; 
use Auth; 

class ClassTimetableController extends Controller
{
    public function list(){ 
        $data['getRecord'] = ClassTimetableModel::getRecord(); 
        $data['header_title'] = 'Class Timetable'; 
        return view('admin.class_timetable.list', $data); 
    } 
    public function add(){ 
        $data['getClass'] = ClassModel::getClass(); 
        $data['getTeacher'] = Teacher::getRecord(); 
        // if(!empty($request->class_id)){
        //     $data['getSubject'] = ClassSubjectModel::MySubject($request->class_id); 
        // }
        $data['header_title'] = 'Add Class Timetable'; 
        return view('admin.class_timetable.add', $data); 
    } 
    public function get_subject(Request $request){
        $getSubject = ClassSubjectModel::MySubject($request->class_id); 
        $html = "<option value=''>Select</option>"; 
        foreach($getSubject as $value){
            $html .= "<option value='".$value->subject_id."'>".$value->subject_name."</option>"; 
        } 
        $json['html'] = $html; 
        echo(json_encode($json)); 
    } 
    public function insert(Request $request){ 
        $existingClassTimetable = ClassTimetableModel::where('class_id', $request->class_id)
                                        ->where('subject_id', $request->subject_id)
                                        ->where('teacher_id', $request->teacher_id)
                                        ->where('day', $request->day) 
                                        ->where('start_time', $request->start_time) 
                                        ->where('end_time', $request->end_time) 
                                        ->where('room_number', $request->room_number) 
                                        ->first(); 
        if($existingClassTimetable){
            return redirect('admin/class_timetable/list')->with('warning', 'Lich hoc da ton tai'); 
        } else{
        $class_timetable = new ClassTimetableModel; 
        $class_timetable->class_id = trim($request->class_id); 
        $class_timetable->subject_id = trim($request->subject_id); 
        $class_timetable->teacher_id = trim($request->teacher_id); 
        $class_timetable->day = trim($request->day); 
        $class_timetable->start_time = trim($request->start_time); 
        $class_timetable->end_time = trim($request->end_time); 
        $class_timetable->room_number = trim($request->room_number); 
        $class_timetable->save(); 
        return redirect('admin/class_timetable/list')->with('success', 'Them lich hoc thanh cong'); 
        }
    } 
    public function edit($id){ 
        $data['getClass'] = ClassModel::getRecord(); 
        $data['getTeacher'] = Teacher::getRecord(); 
        $data['getSubject'] = SubjectModel::getSubject(); 
        $data['getRecord'] = ClassTimetableModel::getSingle($id); 
        return view('admin.class_timetable.edit', $data); 
    } 
    public function update($id, Request $request){
        $class_timetable = ClassTimetableModel::find($id); 
        $class_timetable->class_id = trim($request->class_id); 
        $class_timetable->subject_id = trim($request->subject_id); 
        $class_timetable->teacher_id = trim($request->teacher_id); 
        $class_timetable->day = trim($request->day); 
        $class_timetable->start_time = trim($request->start_time); 
        $class_timetable->end_time = trim($request->end_time); 
        $class_timetable->room_number = trim($request->room_number); 
        $class_timetable->save(); 
        return redirect('admin/class_timetable/list')->with('success', 'Cap nhat lich hoc thanh cong'); 
    } 
    public function delete($id){
        $class_timetable = ClassTimetableModel::find($id); 
        $class_timetable->delete(); 
        return redirect()->back()->with('success', 'Xoa lich hoc thanh cong'); 
    } 
    public function MyClassSubject(){ 
        $teacher_id = DB::table('teacher')->where('user_id', '=', Auth::user()->id)->value('id'); 
        $data['getRecord'] = ClassTimetableModel::getMyClassSubject($teacher_id); 
        $data['header_title'] = 'My Class & Subject'; 
        return view('teacher.my_class_subject', $data); 
    } 
    // student side 
    public function MyTimetable(){ 
        $class_id = DB::table('student')->where('user_id', '=', Auth::user()->id)->value('class_id'); 
        $data['getRecord'] = ClassTimetableModel::getStudentTimetable($class_id); 
        $data['header_title'] = 'My Timetable'; 
        return view('student.my_timetable', $data); 
    } 
    // teacher side 
    public function MyTimetableTeacher(){ 
        $teacher_id = DB::table('teacher')->where('user_id', '=', Auth::user()->id)->value('id'); 
        $data['getRecord'] = ClassTimetableModel::getTeacherTimetable($teacher_id); 
        $data['header_title'] = 'My Timetable'; 
        return view('teacher.my_timetable', $data); 
    }
}
