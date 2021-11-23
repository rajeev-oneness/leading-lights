<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [CommonController::class,'index'])->name('land_page');

Auth::routes();

Route::any('teacher/login', [LoginController::class,'teacher_login'])->name('teacher_login');
Route::any('teacher/register', [RegisterController::class,'teacher_register'])->name('teacher_register');
Route::any('hr/login', [LoginController::class,'hr_login'])->name('hr_login');
Route::any('hr/register', [RegisterController::class,'hr_register'])->name('hr_register');
Route::any('admin/login', [LoginController::class,'admin_login'])->name('admin_login');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Common Function
Route::post('get-fees-by-class',[CommonController::class,'getFeesByClass'])->name('getFeesByClass');
Route::post('get-course-by-class',[CommonController::class,'getCourseByClass'])->name('getCourseByClass');
Route::post('get-student-by-class',[CommonController::class,'getStudentByClass'])->name('getStudentByClass');
Route::post('email-availability',[CommonController::class,'checkEmailExistence'])->name('checkEmailExistence');

Route::group(['as'=>'admin.','prefix' => 'admin'], function(){
    require 'custom/admin.php';
});

Route::group(['as'=>'user.','prefix' => 'user','middleware' => ['auth','student']], function () {
    require 'custom/user.php';
});

Route::group(['as'=>'teacher.','prefix' => 'teacher','middleware' => ['auth','teacher']], function (){
    require 'custom/teacher.php';
});

Route::group(['as'=>'hr.','prefix' => 'hr','middleware' => ['auth','hr']], function (){
    require 'custom/hr.php';
});