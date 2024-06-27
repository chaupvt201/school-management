<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{ 
    protected $table = 'student'; 
    use HasFactory; 
    public function getProfile() 
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic)) 
        {
            return url('upload/profile/'.$this->profile_pic); 
        } 
        else 
        {
            return ""; 
        }
    } 
    static public function getStudentClass($class_id) 
    {
        return self::select('student.id', 'student.first_name', 'student.last_name')
                ->where('student.class_id', '=', $class_id)
                ->orderBy('student.id', 'desc')
                ->get(); 
    }
    static public function getTeacherStudent($teacher_id) 
    {
        $return = self::select('student.*', 'users.email as email', 'class.name as class_name') 
                    ->join('users', 'users.id', 'student.user_id')
                    ->join('class', 'class.id', 'student.class_id') 
                    ->join('class_timetable', 'class_timetable.class_id', 'class.id') 
                    ->where('class_timetable.teacher_id', $teacher_id)
                    ->distinct(); 
        $return = $return->orderBy('student.id', 'desc') 
                         ->paginate(10); 
        return $return; 
    }
}
