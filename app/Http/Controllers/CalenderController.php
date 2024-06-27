<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\ClassTimetableModel; 
use Illuminate\Support\Facades\DB; 
use Auth; 
use App\Models\ExamScheduleModel; 

class CalenderController extends Controller
{
    public function MyCalendar(){ 
        $class_id = DB::table('student')->where('user_id', '=', Auth::user()->id)->value('class_id'); 
        
        $data['getMyTimetable'] = $this->getTimetable($class_id); 
        $data['getExamTimetable'] = $this->getExamTimetable($class_id); 

        $data['header_title'] = 'My Calender'; 
        return view('student.my_calendar', $data); 
    } 
    public function getExamTimetable($class_id){
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
        return $result; 
    }
    public function getTimetable($class_id){
        $result = array(); 
        $getRecord = ClassTimetableModel::getStudentTimetable($class_id); 
        foreach($getRecord as $value) 
        {
            $dataS['name'] = $value->subject_name; 
            $dataS['weekname'] = $value->day; 
            if($value->day == 'Monday') 
            {
                $dataS['fullcalendar'] = 1; 
            } elseif($value->day == 'Tuesday') 
            {
                $dataS['fullcalendar'] = 2;
            } elseif($value->day == 'Wednesday') 
            {
                $dataS['fullcalendar'] = 3; 
            } elseif($value->day == 'Thusday')
            {
                $dataS['fullcalendar'] = 4; 
            } elseif($value->day = 'Friday') 
            {
                $dataS['fullcalendar'] = 5; 
            } elseif($value->day = 'Satursday') 
            {
                $dataS['fullcalendar'] = 6; 
            } elseif($value->day = 'Sunday') 
            {
                $dataS['fullcalendar'] = 0;
            } 
            $dataS['start_time'] = $value->start_time; 
            $dataS['end_time'] = $value->end_time; 
            $dataS['room_number'] = $value->room_number; 
            $result[] = $dataS; 
        } 
        return $result; 
    } 
    // teacher side 
    public function MyCalendarTeacher(){ 
        $result = array(); 
        $teacher_id = DB::table('teacher')->where('user_id', '=', Auth::user()->id)->value('id'); 
        $getRecord = ClassTimetableModel::getCalendarTeacher($teacher_id); 
        foreach($getRecord as $value){
            $dataS['name'] = $value->subject_name; 
            $dataS['class_name'] = $value->class_name; 
            $dataS['week_of_day'] = $value->day; 
            if($value->day == 'Monday') 
            {
                $dataS['fullcalendar'] = 1; 
            } elseif($value->day == 'Tuesday') 
            {
                $dataS['fullcalendar'] = 2;
            } elseif($value->day == 'Wednesday') 
            {
                $dataS['fullcalendar'] = 3; 
            } elseif($value->day == 'Thusday')
            {
                $dataS['fullcalendar'] = 4; 
            } elseif($value->day = 'Friday') 
            {
                $dataS['fullcalendar'] = 5; 
            } elseif($value->day = 'Satursday') 
            {
                $dataS['fullcalendar'] = 6; 
            } elseif($value->day = 'Sunday') 
            {
                $dataS['fullcalendar'] = 0;
            } 
            $dataS['start_time'] = $value->start_time; 
            $dataS['end_time'] = $value->end_time; 
            $dataS['room_number'] = $value->room_number; 
            $result[] = $dataS; 
        } 
        $data['getClassTimetable'] = $result; 
        $data['getExamTimetable'] = ExamScheduleModel::getExamTimetableTeacher($teacher_id); 
        $data['header_title'] = 'My Calendar'; 
        return view('teacher.my_calendar', $data); 
    }
}
