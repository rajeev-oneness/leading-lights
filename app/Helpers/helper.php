<?php

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
			$title = 'Registration successfull';
			$message = 'Please check & update your profile as needed';
			$route = 'hr.profile';
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
	if($feeStructure->class_id > 0){
		$class = \App\Models\Classes::where('id',$feeStructure->class_id)->first();
		if($class){$response = $class->name;}
	}elseif($feeStructure->course_id > 0){
		$course = \App\Models\SpecialCourse::where('id',$feeStructure->course_id)->first();
		if($course){$response = $course->title;}
	}
	return $response;
}
