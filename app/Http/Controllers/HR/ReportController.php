<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Classes;
use App\Models\Group;
use App\Models\Result;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{
    public function index()
    {
        $data['groups'] = Group::latest()->get();
        $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::latest()->get();
        $data['users'] = User::where('role_id', 4)->latest()->get();
        return view('hr.report.index')->with($data);
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
                    'class' => 'required'
                ], $messages = [
                    'student_id.required' => 'This field is required.',
                    'class.required' => 'This field is required.',
                ])->validate();

                $student_id = $request->student_id;
                $data['user_details'] = User::where('id', $student_id)->first();
                $data['all_result'] = Result::where('results.user_id', $student_id)
                    ->where('total_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->get();
                $data['total_marks'] = Result::where('results.user_id', $student_id)
                    ->where('total_marks', '!=', '')
                    ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                    ->sum('total_marks');
                $data['total_full_marks'] = Result::where('results.user_id', $student_id)
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
                        // ->select('results.exam_id')
                        ->where('total_marks', '!=', '')
                        ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                        // ->join('users','users.id_no','=','submit_exams.roll_no')
                        ->get();
                }
                if ($after_explode_class[1] === 'group') {
                    $data['class'] = $after_explode_class[0];
                    $class_details = Group::where('id', $after_explode_class[0])->first('name');

                    $data['all_result'] = Result::where('arrange_exams.user_id', Auth::user()->id)
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
        return view('hr.report.report')->with($data);
    }
}
