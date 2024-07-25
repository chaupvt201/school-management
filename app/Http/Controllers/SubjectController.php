<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\SubjectModel; 
use App\Models\ClassSubjectModel; 
use Illuminate\Support\Facades\DB; 
use Auth; 

class SubjectController extends Controller
{
    public function list() 
    {
        $data['getRecord'] = SubjectModel::getRecord(); 
        $data['header_title'] = 'Danh sách môn học'; 
        return view('admin.subject.list', $data); 
    } 
    public function add() 
    {
        $data['header_title'] = 'Thêm môn học'; 
        return view('admin.subject.add', $data); 
    } 
    public function insert(Request $request) 
    {
        $subject = new SubjectModel; 
        $subject->name = trim($request->name); 
        $subject->type = trim($request->type); 
        $subject->status = trim($request->status); 
       // $subject->created_by = Auth::user()->id; 
        $subject->save(); 
        return redirect('admin/subject/list')->with('success', 'Thêm mới môn học thành công'); 

    } 
    public function edit($id) 
    {
        $data['getRecord'] = SubjectModel::getSingle($id); 
        if(!empty($data['getRecord'])) 
        { 
            $data['header_title'] = 'Cập nhật môn học';
            return view('admin.subject.edit', $data); 
        } 
        else 
        {
            abort(404); 
        }
    } 
    public function update($id, Request $request) 
    {
        $subject = SubjectModel::getSingle($id); 
        $subject->name = $request->name; 
        $subject->type = $request->type; 
        $subject->status = $request->status; 
        $subject->save(); 
        return redirect('admin/subject/list')->with('success', 'Cập nhật môn học thành công'); 

    } 
    public function delete($id) 
    {
        $subject = SubjectModel::getSingle($id); 
        $subject->delete(); 
        return redirect()->back()->with('success', 'Xóa môn học thành công'); 
    } 
    public function MySubject()
    { 
        $class_id = DB::table('student')->where('user_id', Auth::user()->id)->value('class_id'); 
        $data['getRecord'] = ClassSubjectModel::MySubject($class_id); 
        $data['header_title'] = "My Subject"; 
        return view('student.my_subject', $data); 
    }
}
