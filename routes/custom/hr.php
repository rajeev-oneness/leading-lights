<?php

namespace App\Http\Controllers\HR;

use Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Route;

Route::get('profile', [HRController::class, 'index'])->name('profile');
Route::get('change-password', [HRController::class, 'changePassword'])->name('changePassword');
Route::post('update-password', [HRController::class, 'updatePassword'])->name('updatePassword');
Route::post('update-profile', [HRController::class, 'updateProfile'])->name('updateProfile');
Route::post('update-bio', [HRController::class, 'updateBio'])->name('updateBio');
Route::post('certificate-upload/',[HRController::class,'certificate_upload'])->name('certificate_upload');

// ---------------Attendance--------------------------
Route::any('attendance',[HRController::class,'attendance'])->name('attendance');
Route::any('attendance/details',[HRController::class,'attendanceFor'])->name('attendanceFor');
Route::any('attendance/details/date',[HRController::class,'attendanceStudent'])->name('attendanceStudent');
Route::any('attendance/date',[HRController::class,'attendanceShow'])->name('attendanceDate');
Route::any('attendance/details/show/{id}',[HRController::class,'attendanceShowTeacher'])->name('show.teacher.attendance');

// ----------------------Event Management----------------------------
Route::any('event-management', [HRController::class, 'manageEvent'])->name('manage-event');
Route::post('event-management/store', [HRController::class, 'uploadEvevnt'])->name('manage-event.store');

// -----------------------Announcement----------------------------
Route::any('announcement', [HRController::class, 'Announcement'])->name('announcement');
Route::post('announcement/store', [HRController::class, 'announcementUpload'])->name('announcement.store');

// -----------------------Notice----------------------------
Route::any('download_report', [HRController::class, 'downloadReport'])->name('download_report');
