<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\MarksRegisterModel; 

class ExamScheduleModel extends Model
{ 
    protected $table = 'exam_schedule'; 
    use HasFactory; 
    static public function getSingle($id){
        return self::find($id); 
    }
    static public function getRecordSingle($exam_id, $class_id, $subject_id) 
    {
        return self::where('exam_id', '=', $exam_id)
                ->where('class_id', '=', $class_id)
                ->where('subject_id', '=', $subject_id)
                ->first(); 
    } 
    static public function getExam($class_id) 
    {
        return self::select('exam_schedule.*', 'exam.name as exam_name')
                ->join('exam', 'exam.id', 'exam_schedule.exam_id')
                ->where('exam_schedule.class_id', '=', $class_id) 
                ->groupBy('exam_id') 
                ->orderBy('exam_schedule.id', 'desc')
                ->get(); 
    } 
    static public function getExamTeacher($teacher_id){
        return self::select('exam_schedule.*', 'exam.name as exam_name')
                ->join('exam', 'exam.id', 'exam_schedule.exam_id')
                ->join('class_timetable', 'class_timetable.class_id', 'exam_schedule.class_id') 
                ->where('class_timetable.teacher_id', '=', $teacher_id) 
                ->groupBy('exam_schedule.exam_id') 
                ->orderBy('exam_schedule.id', 'desc') 
                ->get(); 
    }
    static public function getExamTimetable($exam_id, $class_id){
        return self::select('exam_schedule.*', 'subject.name as subject_name', 'subject.type as subject_type')
                ->join('subject', 'subject.id', 'exam_schedule.subject_id')
                ->where('exam_schedule.exam_id', '=', $exam_id) 
                ->where('exam_schedule.class_id', '=', $class_id) 
                ->get(); 
    } 
    static public function getSubject($exam_id, $class_id){
        return self::select('exam_schedule.*', 'subject.name as subject_name', 'subject.type as subject_type')
                ->join('subject', 'subject.id', 'exam_schedule.subject_id')
                ->where('exam_schedule.exam_id', '=', $exam_id) 
                ->where('exam_schedule.class_id', '=', $class_id) 
                ->get(); 
    } 
    static public function getExamTimetableTeacher($teacher_id){
        return self::select('exam_schedule.*', 'class.name as class_name', 'subject.name as subject_name', 'exam.name as exam_name')
                ->join('class_timetable', 'class_timetable.class_id', 'exam_schedule.class_id')
                ->join('class', 'class.id', 'exam_schedule.class_id') 
                ->join('subject', 'subject.id', 'exam_schedule.subject_id') 
                ->join('exam', 'exam.id', 'exam_schedule.exam_id')
                ->where('class_timetable.teacher_id', $teacher_id) 
                ->get(); 
    } 
    static public function getMark($student_id, $exam_id, $class_id, $subject_id){
        return MarksRegisterModel::CheckAlreadyMark($student_id, $exam_id, $class_id, $subject_id); 
    }
}
