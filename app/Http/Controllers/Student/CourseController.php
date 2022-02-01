<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function availableFlashCourses(Request $request)
    {
        $user = $request->user();
        if ($user->flash_course_id) {
            if ($user->flash_course_id != '') {
                $user_courses = explode(',', $user->flash_course_id);
                $courses = Course::whereNotIn('id', $user_courses)->latest()->get();
            }
        }else{
            $courses = Course::latest()->get();
        }
        return view('student.new_flash_course', compact('courses'));
    }

    public function addFlashCourses(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required|array',
            'course_id.*' => 'required|min:1|numeric',
        ], $messages = [
            'course_id.required' => 'Please select any course!!'
        ]);
        $selectedCourses = $request->course_id;
        $user = $request->user();
        foreach ($selectedCourses as $course_id) {
            $course = Course::find($course_id);
            $course_start_date = $course->start_date;
            if ($course) {
                $newFee = new \App\Models\Fee;
                $newFee->user_id = $user->id;
                $newFee->class_id = 0;
                $newFee->course_id = 0;
                $newFee->flash_course_id = $course->id;
                $newFee->fee_type = 'flash_course_fee';
                $newFee->payment_month = date("F");
                $newFee->amount = $course->fees;
                $newFee->save();

                // Notification
                createNotification($user->id, 0, 0, 'join_course_student');
            }
        }
        return redirect(route('user.payment'));
        // return view('student.course_checkout',compact('all_courses','total_amount'));
    }
}
