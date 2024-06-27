<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{ 
    protected $table = 'teacher'; 
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
    static public function getRecord() 
    {
        return self::select('teacher.*')
                    ->where('teacher.status', '=', 0)
                    ->orderBy('teacher.id', 'desc')
                    ->get(); 
    }
}
