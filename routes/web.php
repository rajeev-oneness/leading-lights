<?php

namespace App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as'=>'admin.','prefix' => 'admin','middleware' => ['auth','admin']], function(){
    require 'custom/admin.php';
});

Route::group(['as'=>'user.','prefix' => 'user','middleware' => ['auth','student']], function () {
    require 'custom/user.php';
});

Route::group(['as'=>'teacher.','prefix' => 'teacher','middleware' => ['auth','teacher']], function (){
    require 'custom/teacher.php';
});