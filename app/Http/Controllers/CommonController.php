<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\SpecialCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function getFeesByClass(Request $request){
        $class_details = Classes::where('id',$request->class_id)->first();
        if ($class_details) {
            $message = 'success';
            $res = $class_details;
        }else{
            $message = 'error';
            $res = '';
        }
        return response()->json(array(
            'msg' 	    => $message,
            'result'	=> $res
        )); 
    } 
    public function getCourseByClass(Request $request){
        $course_details = SpecialCourse::where('class_id',$request->class_id)->get();
        if ($course_details) {
            $message = 'success';
            $res = $course_details;
        }else{
            $message = 'error';
            $res = '';
        }
        return response()->json(array(
            'msg' 	    => $message,
            'result'	=> $res
        )); 
    } 

    public function getStudentByClass(Request $request){
        $class = $request->class_id;
        $after_explode_class = explode('-', $class);
        if ($after_explode_class[1] === 'class') {
            $students_details = User::where('role_id',4)->where('class',$after_explode_class[0])->latest()->get();
            return response()->json($students_details);
        }
        if ($after_explode_class[1] === 'group') {
            $students_details = User::where('role_id',4)->where('group_ids',$after_explode_class[0])->latest()->get();
            return response()->json($students_details);
        }
    }
}
