<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $data = array();
        if ($user->video_id) {
            $paid_video = explode(',', $user->video_id);
            $videos = Video::whereNotIn('id', $paid_video)->where('video_type',1);
        }

        $data['videos'] = $videos->latest()->get();
        return view('student.join_new_video')->with($data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'video_id' => 'required|array',
            'video_id.*' => 'required|min:1|numeric',
        ], $messages = [
            'video_id.required' => 'Please select any video!!'
        ]);
        $selectedVideo = $request->video_id;
        $user = $request->user();
        foreach ($selectedVideo as $video_id) {
            $video = Video::find($video_id);
            if ($video) {
                $newFee = new \App\Models\Fee;
                $newFee->user_id = $user->id;
                $newFee->class_id = 0;
                $newFee->course_id = 0;
                $newFee->paid_video_id = $video->id;
                $newFee->fee_type = 'paid_video_fee';
                $newFee->payment_month = date("F",strtotime(date('Y-m-d')));
                $newFee->amount = $video->amount;
                $newFee->save();

                // Notification
                createNotification($user->id, 0, 0, 'paid_video_subscription');
            }
        }
        return redirect(route('user.payment'));
        // return view('student.course_checkout',compact('all_courses','total_amount'));
    }
}
