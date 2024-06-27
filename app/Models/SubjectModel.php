<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Request; 

class SubjectModel extends Model
{ 
    protected $table = 'subject'; 
    use HasFactory; 
    static public function getSingle($id) 
    {
        return self::find($id); 
    }
    static public function getRecord() 
    {
        $return = SubjectModel::select('subject.*'); 
                   if(!empty(Request::get('name'))) 
                   {
                    $return = $return->where('subject.name', 'like', '%'.Request::get('name').'%'); 
                   } 
                   if(!empty(Request::get('type'))) 
                   {
                    $return = $return->where('subject.type', '=', Request::get('type')); 
                   } 
                   if(!empty(Request::get('date'))) 
                   {
                    $return = $return->whereDate('subject.created_at', '=', Request::get('date')); 
                   }
                   $return = $return 
                   ->orderBy('subject.id', 'desc') 
                   ->paginate(20); 

        return $return; 
    } 
    static public function getSubject() 
    {
        $return = SubjectModel::select('subject.*') 
                    ->where('subject.status', '=', 0) 
                    ->orderBy('subject.name', 'asc') 
                    ->get(); 
        return $return; 
    }
}
