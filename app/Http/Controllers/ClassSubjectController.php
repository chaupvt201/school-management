<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\ClassSubjectModel; 
use App\Models\ClassModel; 
use App\Models\SubjectModel; 
use Auth; 

class ClassSubjectController extends Controller
{
    public function list(Request $request) 
    {
        $data['getRecord'] = ClassSubjectModel::getRecord(); 
        $data['header_title'] = 'Subject Assign List'; 
        return view('admin.assign_subject.list', $data); 
    } 
    public function add(Request $request) 
    { 
        $data['getClass'] = ClassModel::getClass(); 
        $data['getSubject'] = SubjectModel::getSubject(); 
        $data['header_title'] = 'Subject Assign Add'; 
        return view('admin.assign_subject.add', $data); 
    } 
    public function insert(Request $request) 
    {
        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id) 
            { 
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id); 
                if(!empty($getAlreadyFirst)) 
                {
                    $getAlreadyFirst->status = $request->status; 
                    $getAlreadyFirst->save(); 
                } 
                else 
                {
                    $classsubject = new ClassSubjectModel; 
                    $classsubject->class_id = $request->class_id; 
                    $classsubject->subject_id = $subject_id; 
                    $classsubject->status = $request->status; 
                   // $classsubject->created_by = Auth::user()->id; 
                    $classsubject->save(); 
                }
                
            } 
            return redirect('admin/assign_subject/list')->with('success', 'Subject Assign to Class Successfully'); 
        } 
        else 
        {
            return redirect()->back()->with('error', 'Due to some error pls try again'); 
        }
    } 

    public function edit($id) 
    { 
        $getRecord = ClassSubjectModel::getSingle($id); 
        if(!empty($getRecord)) 
        { 
            $data['getRecord'] = $getRecord; 
            $data['getAssignSubjectID'] = ClassSubjectModel::getAssignSubjectID($getRecord->class_id); 
            $data['getClass'] = ClassModel::getClass(); 
            $data['getSubject'] = SubjectModel::getSubject(); 
            $data['header_title'] = "Eidt Assign Subject"; 
            return view('admin.assign_subject.edit', $data); 
        } 
        else
        {
            abort(404); 
        }
        
    } 
    public function update(Request $request) 
    {
        ClassSubjectModel::deleteSubject($request->class_id); 
        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id) 
            { 
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id); 
                if(!empty($getAlreadyFirst)) 
                {
                    $getAlreadyFirst->status = $request->status; 
                    $getAlreadyFirst->save(); 
                } 
                else 
                {
                    $classsubject = new ClassSubjectModel; 
                    $classsubject->class_id = $request->class_id; 
                    $classsubject->subject_id = $subject_id; 
                    $classsubject->status = $request->status; 
                   // $classsubject->created_by = Auth::user()->id; 
                    $classsubject->save(); 
                }
                
            } 
            
        } 
        return redirect('admin/assign_subject/list')->with('success', 'Subject Assign to Class Successfully'); 
    }
    public function delete($id) 
    {
        $classsubject = ClassSubjectModel::getSingle($id); 
        $classsubject->delete(); 
        return redirect()->back()->with('success', 'Subject deleted sucessfuly'); 
    } 
    public function edit_single($id) 
    {
        $getRecord = ClassSubjectModel::getSingle($id); 
        if(!empty($getRecord)) 
        { 
            $data['getRecord'] = $getRecord; 
            $data['getClass'] = ClassModel::getClass(); 
            $data['getSubject'] = SubjectModel::getSubject(); 
            $data['header_title'] = "Eidt Assign Subject"; 
            return view('admin.assign_subject.edit_single', $data); 
        } 
        else
        {
            abort(404); 
        }
    } 
    public function update_single($id, Request $request) 
    {
        $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id); 
        if(!empty($getAlreadyFirst)) 
        {
            $getAlreadyFirst->status = $request->status; 
            $getAlreadyFirst->save(); 
            return redirect('admin/assign_subject/list')->with('success', 'Status Updated Successfully'); 
        } 
        else 
        {
            $classsubject = ClassSubjectModel::getSingle($id); 
            $classsubject->class_id = $request->class_id; 
            $classsubject->subject_id = $request->subject_id; 
            $classsubject->status = $request->status; 
            $classsubject->save(); 
            return redirect('admin/assign_subject/list')->with('success', 'Subject Assign to Class Successfully'); 
        }
    }
}
