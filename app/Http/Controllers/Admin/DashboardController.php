<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\ArrangeClass;
use App\Models\ArrangeExam;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Event;
use App\Models\Group;
use App\Models\notice;
use App\Models\SpecialCourse;
use App\Models\Subject;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Video;
use App\Models\VLOG;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
   {
      $data = array();
      $data['students_count'] = User::where('role_id',4)->count();
      $data['teachers_count'] = User::where('role_id',3)->count();
      $data['hr_count'] = User::where('role_id',2)->count();
      $data['vlog_count'] = VLOG::count();
      $data['video_count'] = Video::count();
      $data['regular_class_count'] = Classes::count();
      $data['special_course_count'] = SpecialCourse::count();
      $data['flash_course_count'] = Course::count();
      $data['testimonials_count'] = Testimonial::count();
      $data['group_count'] = Group::count();
      $data['subject_count'] = Subject::count();
      $data['news_count'] = notice::count();
      $data['this_week_exam_count'] = ArrangeExam::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
      $data['this_week_arrange_class_count'] = ArrangeClass::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
      $data['this_week_no_of_events'] = Event::whereBetween('start_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
      $data['this_week_no_of_announcement'] = Announcement::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
      return view('admin.dashboard')->with($data);
   }
}
