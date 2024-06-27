<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Request; 

class ExamModel extends Model
{ 
    protected $table = 'exam'; 
    use HasFactory; 
    static public function getSingle($id) 
    {
        return self::find($id); 
    }
    static public function getRecord() 
    {
        $return = self::select('exam.*'); 
        if(!empty(Request::get('name'))){
            $return = $return->where('exam.name', 'like', '%'.Request::get('name').'%'); 
        }
            $return = $return->orderBy('exam.id', 'desc')
                        ->paginate(10); 
        return $return; 
    } 
    static public function getExam() 
    {
        return self::select('exam.*')
                ->orderBy('exam.name', 'asc')->get(); 
    }
}
