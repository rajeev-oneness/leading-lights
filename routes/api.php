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


Route::get('chatting/message',[MessageController::class,'getMessageForUser'])->name('chat.message.list');
Route::post('chatting/message',[MessageController::class,'sendMessageUniversal'])->name('chat.message.post');
Route::post('chatting/mark_as_read',[MessageController::class,'messageRead'])->name('chat.message.read');
