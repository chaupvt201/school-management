<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\ExamModel; 
use App\Models\ClassModel; 
use App\Models\ClassSubjectModel; 
use App\Models\ExamScheduleModel; 
use Illuminate\Support\Facades\DB; 
use Auth; 
use App\Models\ClassTimetableModel; 
use App\Models\Student; 
use App\Models\MarksRegisterModel; 

class ExaminationsController extends Controller
{
    public function exam_list(){ 
        $data['getRecord'] = ExamModel::getRecord(); 
        $data['header_title'] = 'Exam List'; 
        return view('admin.examinations.exam.list', $data); 
    } 
    public function exam_add(){
        $data['header_title'] = 'Add new exam'; 
        return view('admin.examinations.exam.add', $data); 
    } 
    public function exam_insert(Request $request){
        $exam = new ExamModel; 
        $exam->name = trim($request->name); 
        $exam->note = trim($request->note); 
        $exam->save(); 
        return redirect('admin/examinations/exam/list')->with('success', 'Exam created successfully'); 
    } 
    public function exam_edit($id){ 
        $data['getRecord'] = ExamModel::getSingle($id); 
        if(!empty($data['getRecord'])){
        $data['header_title'] = 'Edit exam'; 
        return view('admin.examinations.exam.edit', $data); 
        } 
        else{
            abort(404); 
        }
    } 
    public function exam_update($id, Request $request){
        $exam = ExamModel::getSingle($id); 
        $exam->name = trim($request->name); 
        $exam->note = trim($request->note); 
        $exam->save(); 
        return redirect('admin/examinations/exam/list')->with('success', 'Exam Updated Successfully'); 
    } 
    public function exam_delete($id){
        $exam = ExamModel::find($id); 
        if(!empty($exam)){
        $exam->delete(); 
        return redirect()->back()->with('success', 'Exam delete succesfully'); 
        } 
        else{
            abort(404); 
        }
    } 
    public function exam_schedule(Request $request){
        $data['getClass'] = ClassModel::getClass(); 
        $data['getExam'] = ExamModel::getExam(); 
        $result = array(); 
        if(!empty($request->get('exam_id') & !empty($request->get('class_id')))){
            $getSubject = ClassSubjectModel::MySubject($request->get('class_id')); 
            foreach($getSubject as $value){
                $dataS = array(); 
                $dataS['subject_id'] = $value->subject_id; 
                $dataS['class_id'] = $value->class_id; 
                $dataS['subject_name'] = $value->subject_name; 
                $dataS['subject_type'] = $value->subject_type; 
                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id); 
                if(!empty($ExamSchedule)){
                    $dataS['exam_date'] = $ExamSchedule->exam_date; 
                    $dataS['start_time'] = $ExamSchedule->start_time; 
                    $dataS['end_time'] = $ExamSchedule->end_time; 
                    $dataS['room_number'] = $ExamSchedule->room_number; 
                    $dataS['full_marks'] = $ExamSchedule->full_marks; 
                    $dataS['passing_marks'] = $ExamSchedule->passing_marks; 
                } else{
                    $dataS['exam_date'] = ''; 
                    $dataS['start_time'] = ''; 
                    $dataS['end_time'] = ''; 
                    $dataS['room_number'] = ''; 
                    $dataS['full_marks'] = ''; 
                    $dataS['passing_marks'] = ''; 
                }
                $result[] = $dataS; 
            }
        } 
        $data['getRecord'] = $result; 
        $data['header_title'] = 'exam schedule'; 
        return view('admin.examinations.exam_schedule', $data); 
    } 
    public function exam_schedule_insert(Request $request){ 
        if(!empty($request->schedule)){
            foreach($request->schedule as $schedule){ 
                if(!empty($schedule['subject_id'] && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time'])
                 && !empty($schedule['room_number']) && !empty($schedule['full_marks']) && !empty($schedule['passing_marks']))){ 
                $exam_exist = ExamScheduleModel::where('exam_id', '=', $request->exam_id)
                                ->where('class_id', '=', $request->class_id)
                                ->where('subject_id', '=', $schedule['subject_id'])
                                ->first(); 
                if(!empty($exam_exist)){
                    $exam_exist->exam_date = $schedule['exam_date']; 
                    $exam_exist->start_time = $schedule['start_time']; 
                    $exam_exist->end_time = $schedule['end_time']; 
                    $exam_exist->room_number = $schedule['room_number']; 
                    $exam_exist->full_marks = $schedule['full_marks']; 
                    $exam_exist->passing_marks = $schedule['passing_marks']; 
                    $exam_exist->save(); 
                } 
                else{
                $exam = new ExamScheduleModel; 
                $exam->exam_id = $request->exam_id; 
                $exam->class_id = $request->class_id; 
                $exam->subject_id = $schedule['subject_id']; 
                $exam->exam_date = $schedule['exam_date']; 
                $exam->start_time = $schedule['start_time']; 
                $exam->end_time = $schedule['end_time']; 
                $exam->room_number = $schedule['room_number']; 
                $exam->full_marks = $schedule['full_marks']; 
                $exam->passing_marks = $schedule['passing_marks']; 
                $exam->save(); 
                }
                 } 
            }
        } 
        return redirect()->back()->with('success', 'Exam Schedule saved successfully'); 
    } 
    public function marks_register(Request $request){
        $data['getClass'] = ClassModel::getClass(); 
        $data['getExam'] = ExamModel::getExam(); 
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id'))){
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id')); 
            $data['getStudent'] = Student::getStudentClass($request->get('class_id')); 
        }
        $data['header_title'] = 'Marks Register'; 
        return view('admin.examinations.marks_register', $data); 
    } 
    public function marks_register_teacher(Request $request){
        $teacher_id = DB::table('teacher')->where('user_id', '=', Auth::user()->id)->value('id'); 
        $data['getClass'] = ClassTimetableModel::getMyClassSubjectGroup($teacher_id); 
        $data['getExam'] = ExamScheduleModel::getExamTeacher($teacher_id); 
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id'))){
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id')); 
            $data['getStudent'] = Student::getStudentClass($request->get('class_id')); 
        }
        $data['header_title'] = 'Marks Register'; 
        return view('teacher.marks_register', $data); 
    }
    public function submit_marks_register(Request $request){ 
        $validation = 0; 
        if(!empty($request->mark)){
            foreach($request->mark as $mark){ 
                $getExamSchedule = ExamScheduleModel::getSingle($mark['id']); 
                $full_marks = $getExamSchedule->full_marks; 
                $class_work = !empty($mark['class_work']) ? $mark['class_work'] : 0; 
                $test_work = !empty($mark['test_work']) ? $mark['test_work'] : 0; 
                $exam = !empty($mark['exam']) ? $mark['exam'] : 0; 
                $total_mark = ($class_work + $test_work + $exam)/3; 
                if($full_marks >= $total_mark && $class_work <=100 && $test_work <=100 && $exam <=100){
                $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id,$request->exam_id,$request->class_id,$mark['subject_id']); 
                if(!empty($getMark)){
                    $marksregister = $getMark; 
                }else{
                $marksregister = new MarksRegisterModel; 
                } 
                $marksregister->student_id = $request->student_id; 
                $marksregister->exam_id = $request->exam_id; 
                $marksregister->class_id = $request->class_id; 
                $marksregister->subject_id = $mark['subject_id']; 
                $marksregister->class_work = $class_work; 
                $marksregister->test_work = $test_work; 
                $marksregister->exam = $exam; 
                $marksregister->save(); 
            } else{
                $validation = 1; 
            }
            }
        } 
        if($validation == 0){
            $json['message'] = "Mark Register saved successfuly"; 
        } else{
            $json['message'] = "Mark Register saved successfuly Some Subject mark greater than full mark"; 
        }
       
        echo(json_encode($json)); 
    } 
    public function single_submit_marks_register(Request $request){ 
        $id = $request->id; 
        $getExamSchedule = ExamScheduleModel::getSingle($id); 
        $full_marks = $getExamSchedule->full_marks; 

        $class_work = !empty($request->class_work) ? $request->class_work : 0; 
        $test_work = !empty($request->test_work) ? $request->test_work : 0; 
        $exam = !empty($request->exam) ? $request->exam : 0; 
        $total_mark = ($class_work + $test_work + $exam)/3; 
        if($full_marks >= $total_mark && $class_work <=100 && $test_work <= 100 && $exam <= 100){
            $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id,$request->exam_id,$request->class_id,$request->subject_id); 
            if(!empty($getMark)){
                $marksregister = $getMark; 
            }else{
            $marksregister = new MarksRegisterModel; 
            } 
            $marksregister->student_id = $request->student_id; 
            $marksregister->exam_id = $request->exam_id; 
            $marksregister->class_id = $request->class_id; 
            $marksregister->subject_id = $request->subject_id; 
            $marksregister->class_work = $class_work; 
            $marksregister->test_work = $test_work; 
            $marksregister->exam = $exam; 
            $marksregister->save(); 
    
            $json['message'] = "Mark Register saved successfuly"; 
        } 
        else{
            $json['message'] = "Your total mark greater than full mark"; 
        }

       
        echo(json_encode($json)); 
    }
    public function MyExamTimetable(){ 
        $class_id = DB::table('student')->where('user_id', '=', Auth::user()->id)->value('class_id'); 
        $getExam = ExamScheduleModel::getExam($class_id); 
        $result = array(); 
        foreach($getExam as $value){
            $dataE = array(); 
            $dataE['name'] = $value->exam_name; 
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id); 
            $resultS = array(); 
            foreach($getExamTimetable as $valueS){
                $dataS = array(); 
                $dataS['subject_name'] = $valueS->subject_name; 
                $dataS['exam_date'] = $valueS->exam_date; 
                $dataS['start_time'] = $valueS->start_time; 
                $dataS['end_time'] = $valueS->end_time; 
                $dataS['room_number'] = $valueS->room_number; 
                $dataS['full_marks'] = $valueS->full_marks; 
                $dataS['passing_marks'] = $valueS->passing_marks; 
                $resultS[] = $dataS; 
            } 
            $dataE['exam'] = $resultS; 
            $result[] = $dataE; 
        } 
        $data['getRecord'] = $result; 
        $data['header_title'] = 'My Exam Timetable'; 
        return view('student.my_exam_timetable', $data); 
    } 
    // teacher work side 
    public function MyExamTimetableTeacher(){ 
        $teacher_id = DB::table('teacher')->where('user_id', '=', Auth::user()->id)->value('id'); 
        $getClass = ClassTimetableModel::getMyClassSubjectGroup($teacher_id); 
        $result = array(); 
        foreach($getClass as $class){
            $dataC = array(); 
            $dataC['class_name'] = $class->class_name; 
            $getExam = ExamScheduleModel::getExam($class->class_id); 
            $examArray = array(); 
            foreach($getExam as $exam){
                $dataE = array(); 
                $dataE['exam_name'] = $exam->exam_name; 
                $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id); 
                $subjectArray = array(); 
                foreach($getExamTimetable as $valueS){
                    $dataS = array(); 
                    $dataS['subject_name'] = $valueS->subject_name; 
                    $dataS['exam_date'] = $valueS->exam_date; 
                    $dataS['start_time'] = $valueS->start_time; 
                    $dataS['end_time'] = $valueS->end_time; 
                    $dataS['room_number'] = $valueS->room_number; 
                    $dataS['full_marks'] = $valueS->full_marks; 
                    $dataS['passing_marks'] = $valueS->passing_marks; 
                    $subjectArray[] = $dataS; 
                } 
                $dataE['subject'] = $subjectArray; 
                $examArray[] = $dataE; 
            } 
            $dataC['exam'] = $examArray; 
            $result[] = $dataC; 
        } 
        $data['getRecord'] = $result; 
        $data['header_title'] = 'My Exam Timetable'; 
        return view('teacher.my_exam_timetable', $data); 
    }
}
