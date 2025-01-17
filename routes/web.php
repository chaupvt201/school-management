<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ClassController; 
use App\Http\Controllers\SubjectController; 
use App\Http\Controllers\ClassSubjectController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\StudentController; 
use App\Http\Controllers\TeacherController; 
use App\Http\Controllers\ClassTimetableController; 
use App\Http\Controllers\ExaminationsController; 
use App\Http\Controllers\CalenderController; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });  
Route::get('/', [AuthController::class, 'login']); 
Route::post('login', [AuthController::class, 'Authlogin']); 
Route::get('logout', [AuthController::class, 'logout']); 
Route::get('forgotpassword', [AuthController::class, 'forgotpassword']); 
Route::post('forgotpassword', [AuthController::class, 'PostForgotPassword']); 
Route::get('reset/{token}', [AuthController::class, 'reset']); 
Route::post('reset/{token}', [AuthController::class, 'PostReset']); 


// Route::get('admin/admin/list', function() {
//     return view('admin.admin.list'); 
// }); 
Route::group(['middleware' => 'admin'], function() { 

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']); 
    Route::get('admin/admin/list', [AdminController::class, 'list']); 
    Route::get('admin/admin/add', [AdminController::class, 'add']); 
    Route::post('admin/admin/add', [AdminController::class, 'insert']); 
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']); 
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']); 
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);  

    // teacher url 
    Route::get('admin/teacher/list', [TeacherController::class, 'list']); 
    Route::get('admin/teacher/add', [TeacherController::class, 'add']); 
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']); 
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']); 
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']); 
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']); 
    Route::post('admin/teacher/export_excel', [TeacherController::class, 'export_excel']); 

    // student url 
    Route::get('admin/student/list', [StudentController::class, 'list']); 
    Route::get('admin/student/add', [StudentController::class, 'add']); 
    Route::post('admin/student/add', [StudentController::class, 'insert']); 
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']); 
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']); 
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']); 
    Route::post('admin/student/export_excel', [StudentController::class, 'export_excel']);

    // class url 
    Route::get('admin/class/list', [ClassController::class, 'list']); 
    Route::get('admin/class/add', [ClassController::class, 'add']); 
    Route::post('admin/class/add', [ClassController::class, 'insert']); 
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']); 
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']); 
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);  

    // subject url 
    Route::get('admin/subject/list', [SubjectController::class, 'list']); 
    Route::get('admin/subject/add', [SubjectController::class, 'add']); 
    Route::post('admin/subject/add', [SubjectController::class, 'insert']); 
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']); 
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']); 
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);  

    // class subject url 
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']); 
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']); 
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']); 
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']); 
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']); 
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);  
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']); 
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']); 


    Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list']); 
    Route::get('admin/class_timetable/add', [ClassTimetableController::class, 'add']); 
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']); 
    Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert']); 
    Route::get('admin/class_timetable/edit/{id}', [ClassTimetableController::class, 'edit']); 
    Route::post('admin/class_timetable/edit/{id}', [ClassTimetableController::class, 'update']); 
    Route::get('admin/class_timetable/delete/{id}', [ClassTimetableController::class, 'delete']); 

    Route::get('admin/examinations/exam/list', [ExaminationsController::class, 'exam_list']); 
    Route::get('admin/examinations/exam/add', [ExaminationsController::class, 'exam_add']); 
    Route::post('admin/examinations/exam/add', [ExaminationsController::class, 'exam_insert']); 
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_edit']); 
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_update']); 
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationsController::class, 'exam_delete']); 

    Route::get('admin/examinations/exam_schedule', [ExaminationsController::class, 'exam_schedule']); 
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationsController::class, 'exam_schedule_insert']); 
    Route::get('admin/examinations/marks_register', [ExaminationsController::class, 'marks_register']); 
    Route::post('admin/examinations/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']); 
    Route::post('admin/examinations/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']); 

    Route::get('admin/account', [UserController::class, 'MyAccount']); 
    Route::post('admin/account', [UserController::class, 'UpdateMyAccountAdmin']); 

    Route::get('admin/change_password', [UserController::class, 'change_password']); 
    Route::post('admin/change_password', [UserController::class, 'update_change_password']); 
}); 

Route::group(['middleware' => 'teacher'], function() { 

    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('teacher/change_password', [UserController::class, 'change_password']); 
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']); 

    Route::get('teacher/account', [UserController::class, 'MyAccount']); 
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccount']); 

    Route::get('teacher/my_student', [StudentController::class, 'MyStudent']); 

    Route::get('teacher/my_class_subject', [ClassTimetableController::class, 'MyClassSubject']); 
    Route::get('teacher/class_timetable', [ClassTimetableController::class, 'MyTimetableTeacher']); 
    Route::get('teacher/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetableTeacher']); 
    
    Route::get('teacher/my_calendar', [CalenderController::class, 'MyCalendarTeacher']); 
    Route::get('teacher/marks_register', [ExaminationsController::class, 'marks_register_teacher']); 
    Route::post('teacher/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']); 
    Route::post('teacher/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']); 
}); 

Route::group(['middleware' => 'student'], function() { 

    Route::get('student/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('student/account', [UserController::class, 'MyAccount']); 
    Route::post('student/account', [UserController::class, 'UpdateMyAccountStudent']); 

    Route::get('student/my_subject', [SubjectController::class, 'MySubject']); 
    Route::get('student/my_timetable', [ClasstimetableController::class, 'MyTimetable']); 

    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetable']); 
    
    Route::get('student/change_password', [UserController::class, 'change_password']); 
    Route::post('student/change_password', [UserController::class, 'update_change_password']); 
    Route::get('student/my_calender', [CalenderController::class, 'MyCalendar']); 
    Route::get('student/my_exam_result', [ExaminationsController::class, 'myExamResult']); 
    
}); 

Route::group(['middleware' => 'parent'], function() { 

    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('parent/change_password', [UserController::class, 'change_password']); 
    Route::post('parent/change_password', [UserController::class, 'update_change_password']); 
    
}); 
