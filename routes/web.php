<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::any('teacher/login', [LoginController::class,'teacher_login'])->name('teacher_login');
Route::any('teacher/register', [RegisterController::class,'teacher_register'])->name('teacher_register');
Route::any('admin/login', [LoginController::class,'admin_login'])->name('admin_login');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['as'=>'admin.','prefix' => 'admin'], function(){
    require 'custom/admin.php';
});

Route::group(['as'=>'user.','prefix' => 'user','middleware' => ['auth','student']], function () {
    require 'custom/user.php';
});

Route::group(['as'=>'teacher.','prefix' => 'teacher','middleware' => ['auth','teacher']], function (){
    require 'custom/teacher.php';
});