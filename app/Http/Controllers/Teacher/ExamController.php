<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ArrangeExam;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\Group;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Result;
use App\Models\Subject;
use App\Models\User;
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
        $data['classes'] = Classes::latest()->get();
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
            'exam_type' => 'required',
            'type_of_exam' => 'required'
            // 'upload_file' => 'required|mimes:pdf'
        ],[
           'exam_type.required' => 'Exam category field is required'
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
            $exam->type_of_exam = $request->type_of_exam;
            $exam->save();

            /**
             * Notification send to the Class users
             */
            if ($after_explode_class[1] === 'class') {
                    createNotificationForSpecialCases(Auth::user()->id, $after_explode_class[0], 0, 'exam_scheduled_for_students',date('d-M-Y',strtotime($exam_date)),$request->start_time.' to '.$request->end_time,Auth::user()->id);
            }

            /**
             * Notification send to the Group users
             */
            if ($after_explode_class[1] === 'group') {
                createNotificationForSpecialCases(Auth::user()->id, 0,$after_explode_class[0],'exam_scheduled_for_students',date('d-M-Y',strtotime($exam_date)),$request->start_time.' to '.$request->end_time,Auth::user()->id);
            }

            /**
             * Notification send to admin
             */
            $all_admins = User::where('role_id',1)->get();
            foreach ($all_admins as $key => $admin) {
                createNotificationForSpecialCases($admin->id, 0, 0, 'exam_scheduled',date('d-M-Y',strtotime($exam_date)),$request->start_time.'to'.$request->end_time,Auth::user()->id,);
            }
            return redirect()->route('teacher.exam.index')->with('success', 'Exam upload successfully.You can now add questions.');
        } else {
            return redirect()->back()->with('error', 'Exam already schedule this time')->withInput();;
        }
    }

    // Add descriptive type question
    public function addQuestion(Request $request){
        // dd($request->all());
        $current_user_id = Auth::user()->id;
        $exam_id = $request->exam_id;
        foreach ($request->addMoreInputFields as $key => $input_field) {
            // Check if any image provide or not
            // If Exist then it's store otherwise store null value
            $imageName = null;
            if (!empty($input_field['image'])) {
                $image = $input_field['image'];
                $imageName = imageUpload($image,'question/'.$current_user_id.'/'.$exam_id);
            }
            $req_question = $input_field['question'];
            $req_marks = $input_field['marks'];

            // dd($question,$imageName);
            $question = new Question();
            $question->exam_id = $exam_id;
            $question->question = $req_question;
            $question->image = $imageName;
            $question->marks = $req_marks;
            $question->save();

        }
        return redirect()->back()->with('question_add_success','Question added successfully');
    }

    // View descriptive type question
    public function viewDescQuestion(Request $request,$id){
        $questions = Question::where('exam_id',$id)->get();
        return view('teacher.exam.desc_question_view',compact('questions'));
    }

    // Add MCQ type question
    public function addMCQQuestion(Request $request){
        // dd($request->all());
        $current_user_id = Auth::user()->id;
        $exam_id = $request->exam_id;
        foreach ($request->addMoreInputFields as $key => $input_field) {
            // Check if any image provide or not
            // If Exist then it's store otherwise store null value
            $imageName = null;
            if (!empty($input_field['image'])) {
                $image = $input_field['image'];
                $imageName = imageUpload($image,'question/'.$current_user_id.'/'.$exam_id);
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

    // View MCQ type question
    public function viewMCQQuestion(Request $request,$id){
        $questions = Question::where('exam_id',$id)->get();
        return view('teacher.exam.mcq_question_view',compact('questions'));
    }

    // Add mixed question
    public function addMixedQuestion(Request $request)
    {
        // dd($request->all());
        $current_user_id = Auth::user()->id;
        $exam_id = $request->exam_id;
        foreach ($request->addMoreInputFields as $key => $input_field) {
            $req_question_type = $input_field['question_type'];
            // Check the question type
            // For MCQ type question
            if ($input_field['question_type'] == "1") {
                // Check if any image provide or not
                // If Exist then it's store otherwise store null value
                // $req_image = $input_field['image2'];
                $imageName = null;
                if (!empty($input_field['image2'])) {
                    $image = $input_field['image2'];
                    $imageName = imageUpload($image,'question/'.$current_user_id.'/'.$exam_id);
                }
                // Collect other input values
                $req_question = $input_field['question2'];
                $req_answer = $input_field['answer'];
                $req_option = $input_field['option'];


                //Store question, right answer, question_type and image in "questions" table
                $question = new Question();
                $question->question = $req_question;
                $question->question_type = $req_question_type;
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

            // Check the question type
            // For Descriptive type question
            if ($input_field['question_type'] == "2") {
                    // Check if any image provide or not
                    // If Exist then it's store otherwise store null value
                    $imageName = null;
                    if (!empty($input_field['image1'])) {
                        $image = $input_field['image1'];
                        $imageName = imageUpload($image,'question/'.$current_user_id.'/'.$exam_id);
                    }
                    $req_question = $input_field['question1'];
                    $req_marks = $input_field['marks'];

                    $current_user_id = Auth::user()->id;
                    $exam_id = $request->exam_id;
                    $question = new Question();
                    $question->exam_id = $exam_id;
                    $question->question = $req_question;
                    $question->question_type = $req_question_type;
                    $question->image = $imageName;
                    $question->marks = $req_marks;
                    $question->save();
            }
        }
        return redirect()->back()->with('question_add_success','Question added successfully');

    }

    // View Mixed type question
     public function viewMixedQuestion(Request $request,$id){
        $questions = Question::where('exam_id',$id)->get();
        return view('teacher.exam.mixed_question_view',compact('questions'));
    }

    /* Exam result section*/

    // Submission result filter page
    public function examSubmission()
    {
        $data['groups'] = Group::latest()->where('teacher_id', Auth::user()->id)->get();
        $data['subjects'] = Subject::latest()->get();
        $data['classes'] = Classes::orderBy('name')->get();
        $data['users'] = User::where('role_id', 4)->latest()->get();
        return view('teacher.exam.result.submission_exam_filter')->with($data);
    }

    // View all student submission list
    public function studentExamSubmission(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // $submitted_exams_detail = SubmitExam::where('user_id', Auth::user()->id)
            //     ->join('arrange_exams', 'submit_exams.exam_id', '=', 'arrange_exams.id')
            //     ->orderBy('submit_exams.created_at', 'DESC')
            //     ->get();
            $submitted_exams_detail = ArrangeExam::where('arrange_exams.user_id', Auth::user()->id)
            ->join('results','results.exam_id','=','arrange_exams.id')
            ->orderBy('results.created_at', 'DESC')
            ->get();
            // dd($submitted_exams_detail);

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
                ]);
                $class = $request->class;
                $after_explode_class = explode('-', $class);

                if ($after_explode_class[1] === 'class') {
                    $submitted_exams_detail =  ArrangeExam::
                                                where('arrange_exams.class',$after_explode_class[0])
                                            ->where('arrange_exams.subject', $request->subject)
                                            ->join('results','results.exam_id','=','arrange_exams.id')
                                            ->orderBy('results.created_at', 'DESC')
                                            ->get();
                }
                if ($after_explode_class[1] === 'group') {
                    $submitted_exams_detail =  ArrangeExam::
                                            where('arrange_exams.class',$after_explode_class[0])
                                        ->where('arrange_exams.subject', $request->subject)
                                        ->join('results','results.exam_id','=','arrange_exams.id')
                                        ->orderBy('results.created_at', 'DESC')
                                        ->get();
                }
            }
        }
        return view('teacher.exam.result.submission_exam', compact('submitted_exams_detail'));
    }

    // View  student submitted answer
    public function studentSubmittedAnswer(Request $request,$exam_id,$user_id)
    {
        // dd($exam_id,$user_id);
        if ($request->isMethod('POST')) {
            // dd($request->all());
            // dd($request->index);
            $current_user_id = Auth::user()->id;
            $total_marks = 0;
            $data = $request->all();
            $exam_details = ArrangeExam::find($request->exam_id);
            // dd($exam_details);

            for ($i = 1; $i <= $request->index; $i++) {
                if (isset($data['question_id' . $i])) {
                    // $exam = new Exam();

                    $student_answer = Exam::where('question_id', $data['question_id' . $i])->first();

                    /* For desc question
                     It's claculate total marks frm the teacher given marks */
                    if ($data['question_type'][($i-1)] == 2 || $data['question_type'][($i-1)] == null) {
                            $total_marks = $total_marks + $data['answer' . $i];
                            $student_answer->answer_marks = $data['answer' . $i];
                            $student_answer->save();
                    }
                }
            }


            // dd($yes_ans,$no_ans);
            // Save result details
            $result = Result::where('user_id',$user_id)->where('exam_id',$exam_id)->first();
            // dd($result);

            /* Note: For Mixed type question we have already calculate MCQ answer marks
               in the "results" table. The column name is "temp_marks".
               So here we added temp_marks with the total_marks.
            */
            if ($exam_details->exam_type == 3) {
                $total_marks = $total_marks + $result->temp_marks;
            }
            $result->total_marks = $total_marks;
            // dd($total_marks);
            $result->save();

            return redirect()->route('teacher.studentExamSubmission')->with('Success', 'Marks updated');
        }
        if ($request->isMethod('get')) {
            $data['exam_id'] = $exam_id;
            $data['user_id'] = $user_id;
            $data['exam_type'] = ArrangeExam::find($exam_id)->exam_type;
            $data['exam_details'] = Question::where('questions.exam_id',$exam_id)
            ->where('exams.user_id',$user_id)
            ->join('exams','exams.question_id','=','questions.id')
            ->get();
            $data['exam_result'] = Result::where('user_id',$user_id)
            ->where('exam_id',$exam_id)
            ->where('total_marks','!=',null)
            ->first();
            // dd($data['exam_details']);
            // dd($data['exam_result']);
            return view('teacher.exam.result.desc_question_view')->with($data);
        }
    }
}
