<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route, Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Chatting
Route::post('set_user_device_token',[MessageController::class,'updateDeviceToken'])->name('api.set.user_device_token');
Route::get('chatting/message',[MessageController::class,'getMessageForUser'])->name('api.contact.message.list');
Route::post('chatting/message',[MessageController::class,'sendMessageUniversal'])->name('api.contact.message.post');
Route::post('chatting/mark_as_read',[MessageController::class,'messageRead'])->name('api.chat.message.read');

// Notification
Route::post('/read', [NotificationController::class, 'notificationRead'])->name('notification.read');

Route::get('hr/notification', [NotificationController::class, 'logsNotification'])->name('logs.notification');
Route::post('hr/notification/readall', [NotificationController::class, 'notificationReadAll'])->name('logs.notification.readall');
