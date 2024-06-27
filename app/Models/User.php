<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
use Request; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; 
    static public function getSingle($id) 
    {
        return self::find($id); 
    } 
    static public function getRecord()
    {
        $return = self::select('users.*', 'admin.admin_name as name') 
                       ->join('admin', 'users.id', '=', 'admin.user_id')
                       ->where('user_type', '=', 1); 

                       if(!empty(Request::get('name'))) 
                       {
                        $return = $return->where('admin_name', 'like', '%'.Request::get('name').'%'); 
                       }

                       if(!empty(Request::get('email'))) 
                       {
                        $return = $return->where('email', 'like', '%'.Request::get('email').'%'); 
                       } 
                       if(!empty(Request::get('date'))) 
                       {
                        $return = $return->whereDate('users.created_at', '=', Request::get('date')); 
                       } 

        $return = $return->orderBy('id', 'desc') 
                         ->paginate(2); 
         return $return; 
    } 

    static public function getStudent() 
    {
        $return = self::select('users.*', 'student.*', 'class.name as class_name') 
                       ->join('student', 'student.user_id', '=', 'users.id') 
                       ->join('class', 'class.id', '=', 'student.class_id')
                       ->where('user_type', '=', 3); 

                       if(!empty(Request::get('first_name'))) 
                       {
                        $return = $return->where('student.first_name', 'like', '%'.Request::get('first_name').'%'); 
                       } 
                       if(!empty(Request::get('last_name'))) 
                       {
                        $return = $return->where('student.last_name', 'like', '%'.Request::get('last_name').'%'); 
                       } 
                       if(!empty(Request::get('email'))) 
                       {
                        $return = $return->where('users.email', 'like', '%'.Request::get('email').'%'); 
                       } 
                       if(!empty(Request::get('class'))) 
                       {
                        $return = $return->where('class.name', 'like', '%'.Request::get('class').'%'); 
                       } 
                       if(!empty(Request::get('gender'))) 
                       {
                        $return = $return->where('student.gender', 'like', '%'.Request::get('gender').'%'); 
                       } 
                       if(!empty(Request::get('mobile_number'))) 
                       {
                        $return = $return->where('mobile_number', 'like', '%'.Request::get('mobile_number').'%'); 
                       } 
                       if(!empty(Request::get('date'))) 
                       {
                        $return = $return->whereDate('student.created_at', '=', Request::get('date')); 
                       }
                       if(!empty(Request::get('status'))) 
                       { 
                        $status = (Request::get('status') == 100) ? 0 : 1; 
                        $return = $return->where('student.status', '=', $status); 
                       }

        $return = $return->orderBy('users.id', 'desc') 
                         ->paginate(2); 
         return $return; 
    } 
    static public function getTeacher() 
    {
        $return = self::select('users.*','teacher.*') 
                        ->join('teacher', 'teacher.user_id', '=', 'users.id') 
                        ->where('user_type', '=', 2); 

                        if(!empty(Request::get('first_name'))) 
                       {
                        $return = $return->where('teacher.first_name', 'like', '%'.Request::get('first_name').'%'); 
                       } 
                       if(!empty(Request::get('last_name'))) 
                       {
                        $return = $return->where('teacher.last_name', 'like', '%'.Request::get('last_name').'%'); 
                       } 
                       if(!empty(Request::get('email'))) 
                       {
                        $return = $return->where('users.email', 'like', '%'.Request::get('email').'%'); 
                       } 
                       if(!empty(Request::get('gender'))) 
                       {
                        $return = $return->where('teacher.gender', 'like', '%'.Request::get('gender').'%'); 
                       } 
                       if(!empty(Request::get('mobile_number'))) 
                       {
                        $return = $return->where('mobile_number', 'like', '%'.Request::get('mobile_number').'%'); 
                       } 
                       if(!empty(Request::get('marital_status'))) 
                       {
                        $return = $return->where('marital_status', 'like', '%'.Request::get('marital_status').'%'); 
                       } 
                       if(!empty(Request::get('address'))) 
                       {
                        $return = $return->where('address', 'like', '%'.Request::get('address').'%'); 
                       } 
                       if(!empty(Request::get('date'))) 
                       {
                        $return = $return->whereDate('teacher.created_at', '=', Request::get('date')); 
                       }
                       if(!empty(Request::get('status'))) 
                       { 
                        $status = (Request::get('status') == 100) ? 0 : 1; 
                        $return = $return->where('teacher.status', '=', $status); 
                       }
        
        $return = $return->orderBy('users.id','desc') 
                         ->paginate(2); 
        return $return; 
    }
    static public function getEmailSingle($email)
    {
    return User::where('email', '=', $email)->first(); 
    } 
    static public function getTokenSingle($remember_token) 
    {
        return User::where('remember_token', '=', $remember_token)->first(); 
    } 
    
} 

