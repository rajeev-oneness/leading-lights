<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

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