<?php
    namespace App\Http\Controllers\HR;
    use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;
    
    Route::get('profile', [HRController::class,'index'])->name('profile');
    Route::get('change-password', [HRController::class,'changePassword'])->name('changePassword');
    Route::post('update-password', [HRController::class,'updatePassword'])->name('updatePassword');
    Route::post('update-profile', [HRController::class,'updateProfile'])->name('updateProfile');
    Route::post('update-bio', [HRController::class,'updateBio'])->name('updateBio');
        // ---------------Attendance--------------------------
    Route::any('attendance',[HRController::class,'attendance'])->name('attendance');

    // ----------------------Event Management----------------------------
    Route::any('event-management',[HRController::class,'manageEvevnt'])->name('manage-event');

    // -----------------------Notice----------------------------
    Route::any('notice',[HRController::class,'notice'])->name('notice');


    // -----------------------Notice----------------------------
    Route::any('download_report',[HRController::class,'downloadReport'])->name('download_report');