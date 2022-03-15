<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Classes;
use App\Models\Group;
use App\Models\Result;
use App\Models\Subject;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                    'class_name' => 'required',
                    'selected_term1' => 'required',
                ], $messages = [
                    'student_id.required' => 'This field is required.',
                    'class_name.required' => 'This field is required.',
                    'selected_term1.required' => 'This field is required.',
                ])->validate();

                $student_id = $request->student_id;
                $data['user_details'] = User::where('id', $student_id)->first();
                $data['all_result'] = Result::where('results.user_id', $student_id)
                    ->where('arrange_exams.selected_session',$request->selected_term1)
                    ->where('total_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->get();
                $data['total_marks'] = Result::where('results.user_id', $student_id)
                    ->where('arrange_exams.selected_session',$request->selected_term1)
                    ->where('total_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->sum('total_marks');
                $data['total_full_marks'] = Result::where('results.user_id', $student_id)
                    ->where('arrange_exams.selected_session',$request->selected_term1)
                    ->where('full_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->sum('full_marks');
                // dd($data);
                $pdf = PDF::loadView('student.report', $data);
                return $pdf->download($data['user_details']['id_no'] . '.pdf');
            }
            if (isset($_POST['student_monthly_wise_result'])) {
                // $this->validate($request, [
                //     'student_id' => 'required',
                //     'class_name' => 'required'
                // ]);
                // dd($request->all());
                // dd($request->selected_term1);
                Validator::make($request->all(), [
                    'student_id1' => 'required',
                    'class_name2' => 'required',
                    'select_month' => 'required',
                ], $messages = [
                    'student_id1.required' => 'This field is required.',
                    'class_name2.required' => 'This field is required.',
                    'select_month.required' => 'This field is required.',
                ])->validate();

                $student_id = $request->student_id1;
                $data['user_details'] = User::where('id', $student_id)->first();
                $data['all_result'] = Result::where('results.user_id', $student_id)
                    ->whereMonth('arrange_exams.date',$request->select_month)
                    ->where('total_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->get();
                $data['total_marks'] = Result::where('results.user_id', $student_id)
                    ->whereMonth('arrange_exams.date',$request->select_month)
                    ->where('total_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->sum('total_marks');
                $data['total_full_marks'] = Result::where('results.user_id', $student_id)
                    ->whereMonth('arrange_exams.date',$request->select_month)
                    ->where('full_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->sum('full_marks');
                // dd($data);
                $pdf = PDF::loadView('student.report', $data);
                return $pdf->download($data['user_details']['id_no'] . '.pdf');
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

                    $data['all_result'] = Result::where('arrange_exams.class', $after_explode_class[0])
                        ->selectRaw('DISTINCT results.user_id')
                        ->where('total_marks', '!=', '')
                        ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                        ->get();
                }
                if ($after_explode_class[1] === 'group') {
                    $data['class'] = $after_explode_class[0];
                    $class_details = Group::where('id', $after_explode_class[0])->first('name');

                    $data['all_result'] = Result::where('arrange_exams.user_id', $after_explode_class[0])
                        ->where('arrange_exams.group_id', $after_explode_class[0])
                        ->where('marks', '!=', '')
                        ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
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
