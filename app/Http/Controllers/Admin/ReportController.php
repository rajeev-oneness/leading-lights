<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Classes;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $data = array();
        $data['groups'] = Group::latest()->get();
        $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::latest()->get();
        $data['users'] = User::where('role_id', 4)->latest()->get();
        return view('admin.report.index')->with($data);
    }
    public function report_details(Request $request)
    {
        $data = array();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data['submitted_exams_detail'] = ArrangeExam::join('results','results.exam_id','=','arrange_exams.id')
                                        ->orderBy('results.created_at', 'DESC')
                                        ->get();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['student_wise_result'])) {
                // $this->validate($request, [
                //     'student_id' => 'required',
                //     'class_name' => 'required'
                // ]);

                Validator::make($request->all(), [
                    'student_id' => 'required',
                    'class_name' => 'required'
                ], $messages = [
                    'student_id.required' => 'The student field is required.',
                    'class_name.required' => 'The class field is required.',
                ])->validate();

                $student_id = $request->student_id;
                $data['user_details'] = User::where('id_no', $student_id)->first();
                $data['all_result'] = SubmitExam::where('id_no', $student_id)
                    ->where('marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                    ->get();
                $data['total_marks'] = SubmitExam::where('id_no', $student_id)
                    ->where('marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                    ->sum('marks');
                $data['total_full_marks'] = SubmitExam::where('id_no', $student_id)
                    ->where('marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                    ->sum('full_marks');
                $pdf = PDF::loadView('student.report', $data);
                return $pdf->download($student_id . '.pdf');
            }
            if (isset($_POST['class_wise_result'])) {
                Validator::make($request->all(), [
                    'class_name1' => 'required'
                ], $messages = [
                    'required' => 'The class field is required.',
                ])->validate();


                $class = $request->class_name1;
                $after_explode_class = explode('-', $class);

                if ($after_explode_class[1] === 'class') {
                    $data['class'] = $after_explode_class[0];
                    $class_details = Classes::where('id', $after_explode_class[0])->first('name');

                    $data['all_result'] = SubmitExam::where('arrange_exams.user_id', Auth::user()->id)
                        ->where('arrange_exams.class', $after_explode_class[0])
                        ->where('marks', '!=', '')
                        ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                        // ->join('users','users.id_no','=','submit_exams.roll_no')
                        ->get();
                }
                if ($after_explode_class[1] === 'group') {
                    $data['class'] = $after_explode_class[0];
                    $class_details = Group::where('id', $after_explode_class[0])->first('name');

                    $data['all_result'] = SubmitExam::where('arrange_exams.user_id', Auth::user()->id)
                        ->where('arrange_exams.group_id', $after_explode_class[0])
                        ->where('marks', '!=', '')
                        ->join('arrange_exams', 'arrange_exams.id', '=', 'submit_exams.exam_id')
                        // ->join('users','users.id_no','=','submit_exams.roll_no')
                        ->get();
                }
                $pdf = PDF::loadView('teacher.report', $data);
                return $pdf->download($class_details->name . '-results' . '.pdf');
            }
            if (isset($_POST['view_submission'])) {
                $this->validate($request, [
                    'subject' => 'required',
                    'class' => 'required'
                ],[
                    'class.required' => 'This field is required',
                    'subject.required' => 'This field is required'
                ]);
                $class = $request->class;
                $after_explode_class = explode('-', $class);

                if ($after_explode_class[1] === 'class') {
                    $data['submitted_exams_detail'] = ArrangeExam::
                                         where('arrange_exams.class',$after_explode_class[0])
                                        ->where('arrange_exams.subject', $request->subject)
                                        ->join('results','results.exam_id','=','arrange_exams.id')
                                        ->orderBy('results.created_at', 'DESC')
                                        ->get();
                }
                if ($after_explode_class[1] === 'group') {
                    $data['submitted_exams_detail'] = ArrangeExam::
                                         where('arrange_exams.class',$after_explode_class[0])
                                        ->where('arrange_exams.subject', $request->subject)
                                        ->join('results','results.exam_id','=','arrange_exams.id')
                                        ->orderBy('results.created_at', 'DESC')
                                        ->get();
                }
            }
        }
        return view('admin.report.view')->with($data);
    }
}
