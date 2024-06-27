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
        $data['header_title'] = 'Class List'; 
        return view('admin.class.list', $data); 
    } 
    public function add() 
    {
        $data['header_title'] = "Add New Class"; 
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

        return redirect('admin/class/list')->with('success', 'Class created successfully'); 
    } 
    public function edit($id) 
    { 
        $data['getRecord'] = ClassModel::getSingle($id); 
        if(!empty($data['getRecord'])) 
        {
            $data['header_title'] = 'Edit Class'; 
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

        return redirect('admin/class/list')->with('success', 'Class updated successfully'); 
    } 
    public function delete($id) 
    {
        $class = ClassModel::getSingle($id); 
        $class->delete(); 
        return redirect()->back()->with('success', 'Class deleted sucessfully'); 
    }
}
