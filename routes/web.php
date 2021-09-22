<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\BannerManagementController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CMSPagesController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\VlogController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\UserController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\TeacherController as TeacherTeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as'=>'admin.','prefix' => 'admin','middleware' => ['auth','admin']], function(){
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('cms', CMSPagesController::class);
    Route::resource('banner', BannerManagementController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('vlog', VlogController::class);
    Route::resource('video', VideoController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('announcement', AnnouncementController::class);
    Route::put('/approve/{id}',[StudentController::class,'approval'])->name('students.approve');
});

Route::group(['as'=>'user.','prefix' => 'user','middleware' => ['auth','student']], function () {
    Route::get('dashboard', [StudentDashboardController::class,'index'])->name('dashboard');
    Route::get('profile', [UserController::class,'index'])->name('profile');
    Route::post('update-profile', [UserController::class,'updateProfile'])->name('updateProfile');
    Route::get('change-password', [UserController::class,'changePassword'])->name('changePassword');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('updatePassword');
});

Route::group(['as'=>'teacher.','prefix' => 'teacher','middleware' => ['auth','teacher']], function (){
    Route::get('dashboard', [TeacherDashboardController::class,'index'])->name('dashboard');
    Route::get('profile', [TeacherTeacherController::class,'index'])->name('profile');
    Route::post('update-profile', [TeacherTeacherController::class,'updateProfile'])->name('updateProfile');
    Route::get('change-password', [TeacherTeacherController::class,'changePassword'])->name('changePassword');
    Route::post('update-password', [TeacherTeacherController::class,'updatePassword'])->name('updatePassword');
});


