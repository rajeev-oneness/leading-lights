<?php

namespace App\Http\Controllers\Teacher\Exam;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Classes;
use App\Models\Group;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Subject;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $data['assign_exam'] = ArrangeExam::where('user_id', Auth::user()->id)->latest()->get();
        return view('teacher.exam.index')->with($data);
    }

    public function create()
    {
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::orderBy('name')->get();
        return view('teacher.exam.create')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'class' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'full_marks' => 'required',
            'negative_marks' => 'required',
            'pass_marks' => 'required',
            'exam_type' => 'required'
            // 'result_date' => 'required',
            // 'upload_file' => 'required|mimes:pdf'
        ]);

        $exam_start_time = date('H:i', strtotime($request->start_time));
        $exam_end_time = date('H:i', strtotime($request->end_time));

        $minutes_to_add = 180;
        $current_time = getAsiaTime24(date('Y-m-d H:i:s'));
        $time = new DateTime($request->date . $request->start_time);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        
        $new_time = $time->format('H:i');
        // dd($new_time);
        if ($exam_start_time > $exam_end_time) {
            return redirect()->back()->with('error', 'Please choose valid end time')->withInput();;
        }

        $after_explode_class = explode('-', $request->class);

        $arrange_exam = ArrangeExam::where('class', $after_explode_class[0])
        ->where('date', $request->date)
        ->whereTime('start_time', '<=', $exam_start_time)
        ->whereTime('end_time', '>=', $exam_start_time)
        ->count();
        $group_arrange_exam = ArrangeExam::where('group_id', $after_explode_class[0])
        ->where('date', $request->date)
        ->whereTime('start_time', '<=', $exam_start_time)
        ->whereTime('end_time', '>=', $exam_start_time)
        ->count();

        // $arrange_exam = ArrangeExam::where('class', $request->class)
        //     ->where('date', $request->date)
        //     ->whereTime('start_time', '<=', $exam_start_time)
        //     ->whereTime('end_time', '>=', $exam_start_time)
        //     ->count();
        if ($arrange_exam == 0 && $group_arrange_exam == 0) {
            $class = $request->class;
            $after_explode_class = explode('-', $class);
            
            $exam_date = $request->date;
            $result_date = date('Y-m-d', strtotime($exam_date. ' + 15 days'));

            $exam = new ArrangeExam();
            $exam->user_id = Auth::user()->id;
            if ($after_explode_class[1] === 'class') {
                $exam->class = $after_explode_class[0];
                $exam->group_id = null;
            }
            if ($after_explode_class[1] === 'group') {
                $exam->group_id = $after_explode_class[0];
                $exam->class = null;
            }
            $exam->subject = $request->subject;
            $exam->date = $exam_date;
            $exam->result_date = $result_date;
            $exam->start_time = $request->start_time;
            $exam->end_time = $request->end_time;
            $exam->full_marks = $request->full_marks;
            $exam->pass_marks = $request->pass_marks;
            $exam->negative_marks = $request->negative_marks;
            $exam->exam_type = $request->exam_type;
            $exam->save();

            return redirect()->route('teacher.exam.index')->with('success', 'Exam upload successfully');
        } else {
            return redirect()->back()->with('error', 'Exam already schedule this time')->withInput();;
        }
    }

    public function addQuestion(Request $request){
        // dd($request->all());
        foreach ($request->addMoreInputFields as $key => $input_field) {
            // dd(count($input_field));
            // dd($input_field['question'],$input_field['image']);
            if (count($input_field) == 2) {
                $image = $input_field['image'];
            }
            $req_question = $input_field['question'];

            $current_user_id = Auth::user()->id;
            $exam_id = $request->exam_id;
            if(count($input_field) == 2){
                $imageName = imageUpload($image,'question/'.$current_user_id.'/'.$exam_id);
            }else{
                $imageName = null;
            }

            // dd($question,$imageName);
            $question = new Question();
            $question->exam_id = $exam_id;
            $question->question = $req_question;
            $question->image = $imageName;
            $question->save();
            
        }
        return redirect()->back()->with('question_add_success','Question added successfully');
    }

    public function viewDescQuestion(Request $request,$id){
        $questions = Question::where('exam_id',$id)->get();
        // dd($questions);
        // return response()->json($questions);
        return view('teacher.exam.desc_question_view',compact('questions'));
    }

    public function addMCQQuestion(Request $request){
        // dd($request->all());
        $current_user_id = Auth::user()->id;
        $exam_id = $request->exam_id;
        foreach ($request->addMoreInputFields as $key => $input_field) {
            // Check if any image provide or not
            // If Exist then it's store otherwise store null value
            if (count($input_field) == 2) {
                $image = $input_field['image'];
            }
            if(count($input_field) == 2){
                $imageName = imageUpload($image,'question/'.$current_user_id.'/'.$exam_id);
            }else{
                $imageName = null;
            }

            // Collect other input values
            $req_question = $input_field['question'];
            $req_answer = $input_field['answer'];
            $req_option = $input_field['option'];
    
            //Store question, right answer and image in "questions" table
            $question = new Question();
            $question->question = $req_question;
            $question->exam_id = $exam_id;
            $question->image = $imageName;
            $question->answer = $req_answer;
            $question->save();
    
            //Store question id and all options in "question_options" table
            $question_id = $question->id;
            if (count($req_option) > 0) {
                foreach ($req_option as $key => $option) {
                    $options = new QuestionOption();
                    $options->option = $option;
                    $options->question_id = $question_id;
                    $options->save();
                }  
            }

        }
        return redirect()->back()->with('question_add_success','Question added successfully');
    }

    public function viewMCQQuestion(Request $request,$id){
        $questions = Question::where('exam_id',$id)->get();
        // $all_questions = Question::where('exam_id',$request->exam_id)
        // ->get();
        // foreach ($all_questions as $key => $question) {
        //     $question_id = $question->id;
        //     $questions[] = Question::find($question_id)->optionData;
        // }
        // dd( $questions);
        // dd($questions);
        // return response()->json($questions);
        return view('teacher.exam.mcq_question_view',compact('questions'));
    }
}
