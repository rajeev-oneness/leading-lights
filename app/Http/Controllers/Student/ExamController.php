<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $data['class_wise_exam'] = ArrangeExam::where('class',  Auth::user()->class)->latest()->get();
        $data['group_wise_exam'] = ArrangeExam::where('group_id', Auth::user()->group_ids)->where('group_id','!=',null)->latest()->get();
        return view('student.exam.index')->with($data);
    }

    public function exam(Request $request,$id)
    {
        if ($request->isMethod('GET')) {
            $exam_details = ArrangeExam::find($id);
            $data['exam'] = $exam_details;
            $data['questions'] = Question::where('exam_id',$exam_details->id)->get();

            // Calculate exam time
            $start_time = strtotime($exam_details->start_time);
            $end_time = strtotime($exam_details->end_time);
            $data['exam_time'] = date('H:i',$end_time - $start_time);
            return view('student.exam.exam')->with($data);
        }
        if ($request->isMethod('POST')) {
            // dd($request->all());
            // dd($request->index);
            $current_user_id = Auth::user()->id;
            $yes_ans = 0;
            $no_ans = 0;
            $data = $request->all();

            for ($i=1; $i <= $request->index ; $i++) { 
                if (isset($data['question_id'.$i])) {
                    // if ($exam = Exam::where('user_id', $current_user_id)->where('questions_id', $data['questions_id' . $i])->first()) {
                    // } else {
                    //     $exam = new Exam();
                    // }
                    $exam = new Exam();

                   $question = Question::where('id',$data['question_id'.$i])->first();
                   if ($question->answer === $data['ans'.$i]) {
                       $result[$data['question_id'.$i]] = 'Yes';
                       $exam->is_ans = "Yes";
                       $yes_ans++;
                   } else {
                        $result[$data['question_id'.$i]] = 'No';
                        $exam->is_ans = "No";
                        $no_ans++;
                   }
                   $exam->user_id = $current_user_id;
                   $exam->question_id =  $question->id;
                   $exam->answer = $data['answer'.$i];
                //    $exam->save();

                }
            }
            // Calculation total marks
            if ($yes_ans > 0) {
                $total_marks = $yes_ans;
            }
            if ($no_ans > 0) {
                $total_marks = ($total_marks - $no_ans);
            }

            // dd($total_marks);
            $result = new Result();
            $result->user_id = $current_user_id;
            $result->exam_id = $data['exam_id'];
            $result->yes_ans = $yes_ans;
            $result->no_ans = $no_ans;
            $request->total_marks = $total_marks;
            // $result->save(); 

            return redirect()->route('user.exam.index')->with('Success','Thank you :)');
            
        }

    }
}
