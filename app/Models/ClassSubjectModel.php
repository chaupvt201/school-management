<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Request; 

class ClassSubjectModel extends Model
{ 
    protected $table = 'class_subject'; 
    use HasFactory; 
    static public function getSingle($id) 
    {
        return self::find($id); 
    }
    static public function getRecord() 
    {
        $return = self::select('class_subject.*', 'class.name as class_name', 'subject.name as subject_name') 
                   ->join('subject', 'subject.id', '=', 'class_subject.subject_id') 
                   ->join('class', 'class.id', '=', 'class_subject.class_id'); 


                   if(!empty(Request::get('class_name'))) 
                    {
                        $return = $return->where('class.name', 'like', '%'.Request::get('class_name').'%'); 
                    } 
                    if(!empty(Request::get('subject_name'))) 
                    {
                        $return = $return->where('subject.name', 'like', '%'.Request::get('subject_name').'%'); 
                    } 
                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('class_subject.created_at', '=', Request::get('date')); 
                    } 
        $return = $return->orderBy('class_subject.id', 'desc') 
                   ->paginate(20); 
        return $return; 

    } 
    static public function MySubject($class_id) 
    {
        return self::select('class_subject.*', 'subject.name as subject_name', 'subject.type as subject_type')
                ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
                ->join('class', 'class.id', '=', 'class_subject.class_id') 
                ->where('class_subject.class_id', '=', $class_id) 
                ->where('class_subject.status', '=', 0)
                ->orderBy('class_subject.id', 'desc') 
                ->get(); 
    }
    static public function getAlreadyFirst($class_id, $subject_id) 
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first(); 
    } 
    static public function getAssignSubjectID($class_id) 
    {
        return self::where('class_id', '=', $class_id)->get(); 
    } 
    static public function deleteSubject($class_id) 
    {
        return self::where('class_id', '=', $class_id)->delete(); 
    }
}
