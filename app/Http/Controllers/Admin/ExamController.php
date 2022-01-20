<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Result;
use App\Models\SubmitExam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_exams = ArrangeExam::latest()->get();
        return view('admin.exams.index',compact('all_exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam_details = ArrangeExam::find($id);
        // Delete from "arrange_exam" table
        $exam_details->delete();
        // Delete from "results" table
        Result::where('exam_id',$id)->delete();
        // Delete from "questions" table

        $question_details = Question::where('exam_id',$id)->get();
        foreach ($question_details as $key => $question) {
            $question_id = $question->id;

            if ($question->exam_type == 1) {
                QuestionOption::where('question_id',$question_id)->delete();
                Exam::where('question_id',$question_id)->delete();
            }
            $question->delete();
        }
        return redirect()->back()->with('success','Exam deleted');
    }
}
