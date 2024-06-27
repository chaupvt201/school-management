<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTimetableModel extends Model
{ 
    protected $table = "class_timetable"; 
    use HasFactory; 
    static public function getRecord() 
    {
        return self::select('class_timetable.*', 'subject.name as subject_name', 'teacher.first_name as teacher_firstname', 'teacher.last_name as teacher_lastname')
                ->join('subject', 'subject.id','class_timetable.subject_id')
                ->join('teacher', 'teacher.id','class_timetable.teacher_id') 
                ->get(); 
    } 
    static public function getSingle($id) 
    { 
        return self::find($id); 
    } 
    static public function getMyClassSubject($id)
    {
        return self::select('class_timetable.*', 'class.name as class_name', 'subject.name as subject_name', 'subject.type as subject_type')
                ->join('class', 'class.id', 'class_timetable.class_id')
                ->join('subject', 'subject.id', 'class_timetable.subject_id')
                ->where('class_timetable.teacher_id', $id) 
                ->where('subject.status', '=', 0) 
                ->where('class.status', '=', 0) 
                ->get(); 
    } 
    static public function getMyClassSubjectGroup($id)
    {
        return self::select('class_timetable.*', 'class.name as class_name')
                ->join('class', 'class.id', 'class_timetable.class_id')
                ->where('class_timetable.teacher_id', $id) 
                ->where('class.status', '=', 0) 
                ->groupBy('class_timetable.class_id')
                ->get(); 
    } 
    static function getCalendarTeacher($teacher_id) 
    {
        return self::select('class_timetable.*', 'class.name as class_name', 'subject.name as subject_name')
                ->join('class', 'class.id', 'class_timetable.class_id')
                ->join('subject', 'subject.id', 'class_timetable.subject_id')
                ->where('class_timetable.teacher_id', $teacher_id) 
                ->where('subject.status', '=', 0) 
                ->where('class.status', '=', 0) 
                ->get(); 
    }
    static public function getStudentTimetable($class_id) 
    {
        return self::select('class_timetable.*', 'subject.name as subject_name', 'teacher.first_name as teacher_firstname', 'teacher.last_name as teacher_lastname')
                ->join('subject', 'subject.id', 'class_timetable.subject_id')
                ->join('teacher', 'teacher.id', 'class_timetable.teacher_id') 
                ->join('class', 'class.id', 'class_timetable.class_id') 
                ->where('class_timetable.class_id', $class_id) 
                ->get(); 
    } 
    static public function getTeacherTimetable($teacher_id) 
    {
        return self::select('class_timetable.*', 'subject.name as subject_name', 'teacher.first_name as teacher_firstname', 'teacher.last_name as teacher_lastname')
                ->join('subject', 'subject.id', 'class_timetable.subject_id')
                ->join('teacher', 'teacher.id', 'class_timetable.teacher_id') 
                ->join('class', 'class.id', 'class_timetable.class_id') 
                ->where('class_timetable.teacher_id', $teacher_id) 
                ->get(); 
    }
}
