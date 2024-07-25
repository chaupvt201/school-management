<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Auth; 
use App\Models\ClassModel; 

class ClassController extends Controller
{
    public function list() 
    { 
        $data['getRecord'] = ClassModel::getRecord(); 
        $data['header_title'] = 'Danh sách lớp học'; 
        return view('admin.class.list', $data); 
    } 
    public function add() 
    {
        $data['header_title'] = "Thêm lớp học"; 
        return view('admin.class.add', $data); 
    } 
    public function insert(Request $request) 
    { 
        // $save 
        $class = new ClassModel; 
        $class->name = $request->name; 
        $class->status  = $request->status; 
       // $class->created_by = Auth::user()->id; 
        $class->save(); 

        return redirect('admin/class/list')->with('success', 'Thêm mới lớp học thành công'); 
    } 
    public function edit($id) 
    { 
        $data['getRecord'] = ClassModel::getSingle($id); 
        if(!empty($data['getRecord'])) 
        {
            $data['header_title'] = 'Cập nhật lớp học'; 
            return view('admin.class.edit', $data); 
        } 
        else 
        {
            abort(404); 
        }
       
    } 
    public function update($id, Request $request) 
    {
        $class = ClassModel::getSingle($id); 
        $class->name = $request->name; 
        $class->status = $request->status; 
        $class->save(); 

        return redirect('admin/class/list')->with('success', 'Cập nhật lớp học thành công'); 
    } 
    public function delete($id) 
    {
        $class = ClassModel::getSingle($id); 
        $class->delete(); 
        return redirect()->back()->with('success', 'Xóa lớp học thành công'); 
    }
}
