<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Models\SpecialCourse;
use Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Forgot / Reset Password --------------------------------->
Route::any('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/send-password-link', [ResetPasswordController::class, 'sendResetLink'])->name('sendResetLink');
Route::any('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');
//<---------------------------------- Forgot / Reset Password

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('hr', HRController::class);
    Route::resource('cms', CMSPagesController::class);
    Route::resource('banner', BannerManagementController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('vlog', VlogController::class);
    Route::resource('video', VideoController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('announcement', AnnouncementController::class);
    Route::resource('notification', NotificationController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('special-courses', SpecialCoursesController::class);
    Route::resource('events', EventController::class);
    Route::resource('qualifications', QualificationController::class);
    Route::put('/approve-student/{id}', [StudentController::class, 'approval'])->name('students.approve');
    Route::put('/reject-student/{id}', [StudentController::class, 'reject_student'])->name('students.reject');
    Route::put('/approve-teacher/{id}', [TeacherController::class, 'approval'])->name('teacher.approve');
    Route::put('/reject-teacher/{id}', [TeacherController::class, 'reject_teacher'])->name('teacher.reject');
    Route::put('/approve-hr/{id}', [HRController::class, 'approval'])->name('hr.approve');
    Route::put('/reject-hr/{id}', [HRController::class, 'reject_hr'])->name('hr.reject');

    Route::get('/arrange-classes', [ClassController::class, 'arrange_classes'])->name('arrange_classes');
    Route::delete('/delete-arrange-classes/{id}', [ClassController::class, 'delete_arrange_classes'])->name('delete_arrange_classes');

    Route::post('view-participation', [ClassController::class, 'view_participation'])->name('view_participation');

    Route::post('get-students-by-class', [ClassController::class, 'getStudentsByClass'])->name('getStudentsByClass');

    //Send email user who not payment yet for special courses
    Route::post('monthly-payment-check/{id}', [ClassController::class, 'monthly_payment_check'])->name('monthly_payment_check');
});
