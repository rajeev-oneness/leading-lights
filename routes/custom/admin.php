<?php
    namespace App\Http\Controllers\Admin;
    use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;

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
    Route::resource('notification', NotificationController::class);
    Route::put('/approve/{id}',[StudentController::class,'approval'])->name('students.approve');
