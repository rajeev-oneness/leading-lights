<?php
    namespace App\Http\Controllers\HR;

    use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;
    
    Route::get('profile', [HRController::class,'index'])->name('profile');
