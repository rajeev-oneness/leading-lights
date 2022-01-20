<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [CommonController::class, 'index'])->name('land_page');
Route::get('/available-courses', [CommonController::class, 'availableCourses'])->name('available_courses');
Route::get('/flash-courses', [CommonController::class, 'flashCourses'])->name('flash_courses');
Route::get('/flash-courses-details/{id}', [CommonController::class, 'flashCourseDetails'])->name('flash_course_details');
Route::get('/student-galary', [CommonController::class, 'studentGalary'])->name('student-galary');
Route::get('/available-events', [CommonController::class, 'availableEvents'])->name('available_events');
Route::get('/vlog', [CommonController::class, 'vlog'])->name('vlog');
Route::get('/vlog-details/{id}', [CommonController::class, 'vlogDetails'])->name('vlogDetails');

Route::get('/video', [CommonController::class, 'video'])->name('video');
Route::get('/video-details/{id}', [CommonController::class, 'videoDetails'])->name('video_details');

Auth::routes();

Route::any('student/video-subscription/{id}', [RegisterController::class, 'video_subscription'])->name('video_subscription');

Route::any('student/flash-course-register/{id}', [RegisterController::class, 'student_flash_course_register'])->name('student_flash_course_register');
Route::any('teacher/login', [LoginController::class, 'teacher_login'])->name('teacher_login');
Route::any('teacher/register', [RegisterController::class, 'teacher_register'])->name('teacher_register');
Route::any('hr/login', [LoginController::class, 'hr_login'])->name('hr_login');
Route::any('hr/register', [RegisterController::class, 'hr_register'])->name('hr_register');
Route::any('admin/login', [LoginController::class, 'admin_login'])->name('admin_login');
Route::any('super-admin/login', [LoginController::class, 'super_admin_login'])->name('super_admin_login');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Common Function
Route::post('get-fees-by-class', [CommonController::class, 'getFeesByClass'])->name('getFeesByClass');
Route::post('get-course-by-class', [CommonController::class, 'getCourseByClass'])->name('getCourseByClass');
Route::post('get-student-by-class', [CommonController::class, 'getStudentByClass'])->name('getStudentByClass');
Route::post('email-availability', [CommonController::class, 'checkEmailExistence'])->name('checkEmailExistence');

// Notification
Route::post('/read', [NotificationController::class, 'notificationRead'])->name('notification.read');

Route::get('hr/notification', [NotificationController::class, 'logsNotification'])->name('logs.notification');
Route::get('student/notification', [NotificationController::class, 'logsNotificationForStudentEvent'])->name('student.logs.notification');
Route::get('teacher/notification', [NotificationController::class, 'logsNotificationForTeacher'])->name('teacher.logs.notification');
Route::post('hr/notification/readall', [NotificationController::class, 'notificationReadAll'])->name('logs.notification.readall');
// Route::post('student/notification/readall', [NotificationController::class, 'studentNotificationReadAll'])->name('student.logs.notification.readall');

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    require 'custom/admin.php';
});

Route::group(['as' => 'superAdmin.', 'prefix' => 'super-admin'], function () {
    require 'custom/superAdmin.php';
});

Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth', 'student']], function () {
    require 'custom/user.php';
});

Route::group(['as' => 'teacher.', 'prefix' => 'teacher', 'middleware' => ['auth', 'teacher']], function () {
    require 'custom/teacher.php';
});

Route::group(['as' => 'hr.', 'prefix' => 'hr', 'middleware' => ['auth', 'hr']], function () {
    require 'custom/hr.php';
});

Route::post('payment/capture', [PaymentController::class, 'storeRazorePayPayment'])->name('payment.capture');

Route::get('migrate', function () {
    \Artisan::call('migrate');
});
