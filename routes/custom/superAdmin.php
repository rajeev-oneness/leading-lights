<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth, Illuminate\Support\Facades\Route;


// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Forgot / Reset Password --------------------------------->
// Route::any('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('forgotPassword');
// Route::post('/send-password-link', [ResetPasswordController::class, 'sendResetLink'])->name('sendResetLink');
// Route::any('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');
//<---------------------------------- Forgot / Reset Password

Route::group(['middleware' => ['auth', 'superAdmin']], function () {
    Route::resource('admin', SuperAdminController::class);
    Route::put('/approve-admin/{id}', [SuperAdminController::class, 'approval'])->name('admin.approve');
    Route::put('/reject-admin/{id}', [SuperAdminController::class, 'reject_admin'])->name('admin.reject');
    Route::put('/deactivate-admin/{id}', [SuperAdminController::class, 'deactivate_account'])->name('admin.deactivate');
    Route::put('/activate-admin/{id}', [SuperAdminController::class, 'activate_account'])->name('admin.activate');
});
