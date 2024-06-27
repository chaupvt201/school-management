<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Request; 

class ClassModel extends Model
{ 
    protected $table ='class'; 
    use HasFactory; 
    static public function getSingle($id) 
    {
        return self::find($id); 
    }
    static public function getRecord() 
    {
        $return = ClassModel::select('class.*'); 
                    if(!empty(Request::get('name'))) 
                    {
                        $return = $return->where('class.name', 'like', '%'.Request::get('name').'%'); 
                    } 
                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('class.created_at', '=', Request::get('date')); 
                    } 
                    $return = $return 
                    ->orderBy('class.id', 'desc') 
                    ->paginate(20); 
        return $return; 
    } 
    static public function getClass() 
    {
        $return = ClassModel::select('class.*') 
                   ->where('class.status', '=', 0) 
                   ->orderBy('class.name', 'asc') 
                   ->get(); 
        return $return; 
    }
}
