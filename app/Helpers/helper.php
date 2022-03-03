<?php

use App\Models\Course;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\SpecialCourse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function randomGenerator()
{
	return uniqid() . '' . date('ymdhis') . '' . uniqid();
}

function successResponse($msg = '', $data = [], $status = 200)
{
	return response()->json(['error' => false, 'status' => $status, 'message' => $msg, 'data' => $data]);
}

function errorResponse($msg = '', $data = [], $status = 200)
{
	return response()->json(['error' => true, 'status' => 200, 'message' => $msg]);
	// return response()->json(['error'=>true,'status'=>$status,'message'=>$msg,'data'=>$data]);
}

function strQuotationCheck($string = "")
{
	$returnString = '';
	for ($i = 0; $i < strlen($string); $i++) {
		if ($string[$i] == '"') {
			$returnString .= '&#34;';
		} else if ($string[$i] == "'") {
			$returnString .= '&#39;';
		} else {
			$returnString .= $string[$i];
		}
	}
	return $returnString;
}

function emptyCheck($string, $date = false)
{
	if ($date) {
		return !empty($string) ? $string : '0000-00-00';
	}
	return !empty($string) ? $string : '';
}

function imageUpload($image, $folder = 'image')
{
	$random = randomGenerator();
	$image->move('upload/' . $folder . '/', $random . '.' . $image->getClientOriginalExtension());
	$imageurl = 'upload/' . $folder . '/' . $random . '.' . $image->getClientOriginalExtension();
	// dd($imageurl);
	return $imageurl;
}
function fileUpload($file, $folder = 'image', $file_name)
{
	// $random = randomGenerator();
	$file->move('upload/' . $folder . '/', $file_name . '.' . $file->getClientOriginalExtension());
	$fileurl = 'upload/' . $folder . '/' . $file_name . '.' . $file->getClientOriginalExtension();
	return $fileurl;
}

function generateUniqueCode($length = 5)
{
	$chars = '0123456789';
	$ret = '';
	for ($i = 0; $i < $length; ++$i) {
		$random = str_shuffle($chars);
		$ret .= $random[0];
	}
	return $ret;
}

function getAsiaTime($date)
{
	$date = new DateTime($date);
	$timezone = new DateTimeZone('Asia/Kolkata');
	$set_timezone =  $date->setTimezone($timezone)->format('h:i');
	return $set_timezone;
}

function getAsiaTime24($date)
{
	$date = new DateTime($date);
	$timezone = new DateTimeZone('Asia/Kolkata');
	$set_timezone =  $date->setTimezone($timezone)->format('H:i');
	return $set_timezone;
}

// function createNotification_old($user, $class, $group, $type)
// {
// 	switch ($type) {
// 		case 'user_registration':
// 			$title = 'Registration successfull';
// 			$message = 'Please check & update your profile as needed';
// 			$route = 'hr.profile';
// 			break;

// 		case 'event_create':
// 			$title = 'Event created';
// 			$message = 'Please check & update your profile as needed';
// 			$route = 'hr.manage-event.store';
// 			break;

// 		default:
// 			$title = '';
// 			$message = '';
// 			$route = '';
// 			break;
// 	}

// 	$notification = new App\Models\Notification;
// 	$notification->user_id = $user;
// 	$notification->class_id = $class;
// 	$notification->group_id = $group;
// 	$notification->type = $type;
// 	$notification->title = $title;
// 	$notification->message = $message;
// 	$notification->route = $route;
// 	$notification->save();
// }

function createNotification($user, $class = 0, $group = 0, $type)
{
	$title = '';
	$message = '';
	$route = '';
	switch ($type) {
		case 'event_create':
			$title = 'Event created';
			$message = 'Please check & update your profile as needed';
			$route = 'user.dairy';
			break;
		case 'user_registration':
			$title = 'Registration successful';
			$message = 'Please check & update your profile as needed';
			$route = 'hr.profile';
			break;
		case 'update_hr_address':
			$title = 'Address update successful';
			$message = 'Please check & update your profile as needed';
			$route = 'hr.profile';
			break;
		case 'update_hr_bio':
			$title = 'Bio update successful';
			$message = 'Please check & update your profile as needed';
			$route = 'hr.profile';
			break;
		case 'announcement_create':
			$title = 'Announcement Create successful';
			$message = 'Please check & update announcement as needed';
			$route = 'hr.announcement';
			break;
		case 'hr_change_password':
			$title = 'Password change successful';
			$message = 'Please check & update your profile as needed';
			$route = 'hr.profile';
			break;
		case 'teacher_registration':
			$title = 'Registration successful';
			$message = 'Please check & update your profile as needed';
			$route = 'teacher.profile';
			break;

		case 'update_teacher_profile':
			$title = 'Profile update successful';
			$message = 'Please check & update your profile as needed';
			$route = 'teacher.profile';
			break;
		case 'teacher_arrange_class':
			$title = 'Class arrange';
			$message = 'Please check & update as needed';
			$route = 'user.classes';
			break;
		case 'teacher_upload_homework':
			$title = 'Homework Uploaded';
			$message = 'Please check & update as needed';
			$route = 'user.homework';
			break;
		case 'teacher_change_password':
			$title = 'Password change successful';
			$message = 'Please check & update your profile as needed';
			$route = 'teacher.profile';
			break;
		case 'student_registration':
			$title = 'Registration successful';
			$message = 'Please check & update your profile as needed';
			$route = 'user.profile';
			break;
		case 'update_student_bio':
			$title = 'Bio update successful';
			$message = 'Please check & update your profile as needed';
			$route = 'user.profile';
			break;
		case 'student_change_password':
			$title = 'Password change successful';
			$message = 'Please check & update your profile as needed';
			$route = 'user.profile';
			break;
		case 'upload_student_hometask':
			$title = 'Home task upload successful';
			$message = 'Please check & update your profile as needed';
			$route = 'user.homework';
			break;
		case 'join_course_student':
			$title = 'Join new course successful';
			$message = 'Please check & update your profile as needed';
			$route = 'user.profile';
			break;
		case 'payment_student':
			$title = 'Payment successful';
			$message = 'Please check & update your profile as needed';
			$route = 'user.profile';
			break;
		case 'paid_video_subscription':
			$title = 'Video added successfully';
			$message = 'Congratulation,Now you can download this video';
			$route = 'user.profile';
			break;
	}
	$notification = [];
	if ($class > 0) {
		$users = App\Models\User::where('class', $class)->get();
		foreach ($users as $user) {
			$notification[] = [
				'user_id' => $user->id,
				'class_id' => $user->class,
				'group_id' => $group,
				'type' => $type,
				'title' => $title,
				'message' => $message,
				'route' => $route,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
			];
		}
	} elseif ($group > 0) {
		$users = App\Models\User::where('group_ids', $group)->get();
		foreach ($users as $user) {
			$notification[] = [
				'user_id' => $user->id,
				'class_id' => $class,
				'group_id' => $user->group_ids,
				'type' => $type,
				'title' => $title,
				'message' => $message,
				'route' => $route,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
			];
		}
	} else {
		$notification[] = [
			'user_id' => $user,
			'class_id' => $class,
			'group_id' => $group,
			'type' => $type,
			'title' => $title,
			'message' => $message,
			'route' => $route,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
		];
	}
	if (count($notification) > 0) {
		\App\Models\Notification::insert($notification);
	}
	return $notification;
}

function createNotificationForSpecialCases($user, $class = 0, $group = 0, $type,$examDate = '',$examTime = '',$teacherId){
	$title = '';
	$message = '';
	$route = '';
	$teacherDetails = User::find($teacherId);
	switch ($type) {
		case 'exam_scheduled':
			$title = 'Exam  scheduled by '.$teacherDetails->first_name.' '.$teacherDetails->last_name;
			$message = 'Exam scheduled by '.$teacherDetails->first_name.' '.$teacherDetails->last_name.'.Please check that' ;
			$route = 'admin.exams.index';
			break;
		case 'exam_scheduled_for_students':
			$title = 'Exam  scheduled by '.$teacherDetails->first_name.' '.$teacherDetails->last_name.' in '.$examDate;
			$message = 'Exam scheduled by '.$teacherDetails->first_name.' '.$teacherDetails->last_name.' at '.$examTime .' in '.$examDate;
			$route = 'user.exam.index';
			break;
	}
	$notification = [];
	if ($class > 0) {
		$users = App\Models\User::where('class', $class)->get();
		foreach ($users as $user) {
			$notification[] = [
				'user_id' => $user->id,
				'class_id' => $user->class,
				'group_id' => $group,
				'type' => $type,
				'title' => $title,
				'message' => $message,
				'route' => $route,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
			];
		}
	} elseif ($group > 0) {
		$users = App\Models\User::where('group_ids', $group)->get();
		foreach ($users as $user) {
			$notification[] = [
				'user_id' => $user->id,
				'class_id' => $class,
				'group_id' => $user->group_ids,
				'type' => $type,
				'title' => $title,
				'message' => $message,
				'route' => $route,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
			];
		}
	} else {
		$notification[] = [
			'user_id' => $user,
			'class_id' => $class,
			'group_id' => $group,
			'type' => $type,
			'title' => $title,
			'message' => $message,
			'route' => $route,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
		];
	}
	if (count($notification) > 0) {
		\App\Models\Notification::insert($notification);
	}
	return $notification;
}
function getNameofClassOrCourse($feeStructure)
{
	$response = '';
	if ($feeStructure->class_id > 0) {
		$class = \App\Models\Classes::where('id', $feeStructure->class_id)->first();
		if ($class) {
			$response = $class->name;
		}
	} elseif ($feeStructure->course_id > 0) {
		$course = \App\Models\SpecialCourse::where('id', $feeStructure->course_id)->first();
		if ($course) {
			$response = $course->title;
		}
	}
	return $response;
}
function getNameofFlashCourse($feeStructure)
{
	$response = '';
	if ($feeStructure->flash_course_id > 0) {
		$course = Course::find($feeStructure->flash_course_id);
		if ($course) {
			$response = $course->title;
		}
	}
	return $response;
}

function getNameofCourse($fee_details)
{
	$response = '';
    if ($fee_details->course_id > 0) {
		$course = \App\Models\SpecialCourse::where('id', $fee_details->course_id)->first();
		if ($course) {
			$response = $course->title;
		}
	}
	return $response;
}
function getNameOfPaidVideo($fee_details)
{
	$response = '';
    if ($fee_details->paid_video_id > 0) {
		$course = \App\Models\Video::where('id', $fee_details->paid_video_id)->first();
		if ($course) {
			$response = $course->title;
		}
	}
	return $response;
}

function extraDateFineCalculation($class_id,$course_id,$due_date,$user_id){
    $previous_payment = DB::table('fees')
                        ->where('user_id',$user_id)
                        ->where('course_id',$course_id)
                        ->where('class_id',$class_id)
                        ->first();
    if (!empty($previous_payment)) {
		if (Auth::user()->registration_type != 2 && Auth::user()->registration_type != 3 && Auth::user()->registration_type != 4) {
			if (Auth::user()->registration_type == 1) {
				if ($course_id > 0) {
					return 0;
				}else{
					//Next date for payment
					$next_due_date = $due_date;
					$today_date = date('Y-m-d');

					if ($today_date > $next_due_date) {
						$date1=date_create($next_due_date);
						$date2=date_create($today_date);
						$diff=date_diff($date1,$date2);
						$extra_date = $diff->format("%a");
						return $extra_date;
					}else{
						return 0;
					}
				}
			}
		}else{
			return 0;
		}
    }
}

/**
 * Check user make first payment or not
 */

function checkPaymentStatus($student_id)
{
    $all_payment_details = Fee::where('user_id',$student_id)->latest()->get();
    if ($all_payment_details->count() > 0) {
        $last_payment = Fee::where('user_id',$student_id)->where('transaction_id','!=',0)->orderBy('id', 'desc')->first();
        if ( !empty($last_payment)) {
            return 1;
        }else{
            return 0;
        }
    }
}


/**
 * Check specific user special course registered or not
 */

 function checkSpecialCourseSubscription($student_id){
	$user_details = User::find($student_id);
	$subscribe_special_course_id = $user_details->special_course_ids;
	if ($user_details->registration_type == 1) {
		$special_courses = SpecialCourse::where('class_id',$user_details->class)->latest()->get();
		return $special_courses;
	}
	else if($user_details->registration_type == 2) {
		if ($user_details->class) {
			$special_courses = SpecialCourse::where('class_id',$user_details->class)->latest()->get();
		} else {
			$special_courses = SpecialCourse::where('class_id', null)->latest()->get();
		}
		return $special_courses;
	}
 }