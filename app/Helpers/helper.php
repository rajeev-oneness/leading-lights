<?php 

    function randomGenerator()
	{
		return uniqid().''.date('ymdhis').''.uniqid();
	}

	function imageUpload($image,$folder='image')
	{
		$random = randomGenerator();
		$image->move('upload/'.$folder.'/',$random.'.'.$image->getClientOriginalExtension());
        $imageurl = 'upload/'.$folder.'/'.$random.'.'.$image->getClientOriginalExtension();
        return $imageurl;
	}
	function fileUpload($file,$folder='image',$file_name)
	{
		// $random = randomGenerator();
		$file->move('upload/'.$folder.'/',$file_name.'.'.$file->getClientOriginalExtension());
        $fileurl = 'upload/'.$folder.'/'.$file_name.'.'.$file->getClientOriginalExtension();
        return $fileurl;
	}

	function generateUniqueCode($length = 5) {
		$chars = '0123456789';
		$ret = '';
		for($i = 0; $i < $length; ++$i) {
		  $random = str_shuffle($chars);
		  $ret .= $random[0];
		}
		return $ret;
	}

	function getAsiaTime($date){
		$date = new DateTime($date);
		$timezone = new DateTimeZone('Asia/Kolkata');
		$set_timezone =  $date->setTimezone($timezone)->format('h:i');
		return $set_timezone;
	}

	function getAsiaTime24($date){
		$date = new DateTime($date);
		$timezone = new DateTimeZone('Asia/Kolkata');
		$set_timezone =  $date->setTimezone($timezone)->format('H:i');
		return $set_timezone;
	}