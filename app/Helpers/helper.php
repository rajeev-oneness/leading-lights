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

	function generateUniqueCode($length = 5) {
		$chars = '0123456789';
		$ret = '';
		for($i = 0; $i < $length; ++$i) {
		  $random = str_shuffle($chars);
		  $ret .= $random[0];
		}
		return $ret;
	}