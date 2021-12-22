<?php
    namespace App\Http\Controllers\Teacher;

use Illuminate\Support\Facades\Auth,Illuminate\Support\Facades\Route;

    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('profile', [TeacherController::class,'index'])->name('profile');
    Route::post('update-profile', [TeacherController::class,'updateProfile'])->name('updateProfile');
    Route::get('change-password', [TeacherController::class,'changePassword'])->name('changePassword');
    Route::post('update-password', [TeacherController::class,'updatePassword'])->name('updatePassword');
    Route::get('home-task',[TeacherController::class,'homeTask'])->name('homeTask');
    Route::post('upload-home-task',[TeacherController::class,'uploadHomeTask'])->name('uploadHomeTask');

    Route::any('attendance',[TeacherController::class,'attendance'])->name('attendance');
    Route::get('access-class',[TeacherController::class,'class'])->name('class');
    Route::get('task-submission',[TeacherController::class,'studentSubmission'])->name('studentSubmission');
    Route::get('video-call',[TeacherController::class,'videoCall'])->name('videoCall');

    /* Exam */
    Route::get('exam/manage-exam',[ExamController::class,'index'])->name('exam.index');
    Route::get('exam/create-exam',[ExamController::class,'create'])->name('exam.create');
    Route::post('exam/assign-exam',[ExamController::class,'store'])->name('exam.store');
    Route::post('exam/add-question-in-exam',[ExamController::class,'addQuestion'])->name('addQuestion');
    Route::get('exam/view-desc-question/{id}',[ExamController::class,'viewDescQuestion'])->name('viewDescQuestion');
    Route::post('exam/add-mcq-question-in-exam',[ExamController::class,'addMCQQuestion'])->name('addMCQQuestion');
    Route::get('exam/view-mcq-question/{id}',[ExamController::class,'viewMCQQuestion'])->name('viewMCQQuestion');
    Route::post('exam/add-mixed-question-in-exam',[ExamController::class,'addMixedQuestion'])->name('addMixedQuestion');
    Route::get('exam/view-mixed-question/{id}',[ExamController::class,'viewMixedQuestion'])->name('viewMixedQuestion');

    /* Exam result details*/
    Route::get('student/exam-submission',[ExamController::class,'examSubmission'])->name('examSubmission');
    Route::any('student/exam-submission/details',[ExamController::class,'studentExamSubmission'])->name('studentExamSubmission');
    Route::any('student/exam-submission/answers/{exam_id}/{user_id}',[ExamController::class,'studentSubmittedAnswer'])->name('studentSubmittedAnswer');


    Route::post('task-review',[TeacherController::class,'taskReview'])->name('taskReview');
    Route::post('task-comment/{id}',[TeacherController::class,'taskComment'])->name('taskComment');

    Route::post('certificate-upload/',[TeacherController::class,'certificate_upload'])->name('certificate_upload');

    Route::post('arrange-class/',[TeacherController::class,'arrange_class'])->name('arrange_class');

    Route::post('class-attendance',[TeacherController::class,'class_attendance'])->name('class_attendance');


    Route::post('exam-marks/{id}',[TeacherController::class,'examMarks'])->name('examMarks');
    Route::post('exam-comment/{id}',[TeacherController::class,'examComment'])->name('examComment');

    Route::post('view-participation',[TeacherController::class,'view_participation'])->name('view_participation');

    Route::get('assigned-groups',[TeacherController::class,'assigned_groups'])->name('assigned_groups');

    // Whiteboard
    Route::get('whiteboard',[TeacherController::class,'whiteboard'])->name('whiteboard');


