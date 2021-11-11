<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classes;
use App\Models\Payment;
use App\Models\ArrangeClass;
use Illuminate\Http\Request;
use App\Models\SpecialCourse;
use App\Models\ClassAttendance;
use App\Http\Controllers\Controller;
use App\Notifications\PaymentDueNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::orderBy('name')->get();
        return view('admin.class.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::where('role_id',3)->where('status',1)->latest()->get();
        return view('admin.class.create',compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255|unique:classes',
            'admission_fees' => 'required|min:1',
            'monthly_fees' => 'required|min:1',
        ]);
      
        $class = new Classes();
        $class->name = $request->name;
        $class->admission_fees = $request->admission_fees;
        $class->monthly_fees = $request->monthly_fees;
        $class->save();
        return redirect()->route('admin.classes.index')->with('success','Class added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['class_details'] = Classes::find($id);
        $data['teacher'] = User::where('id',$data['class_details']['teacher_id'])->first();
        return view('admin.class.view')->with($data); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['class_details'] = Classes::find($id);
        return view('admin.class.edit')->with($data); 
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
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'admission_fees' => 'required|min:1',
            'monthly_fees' => 'required|min:1',
        ]);

        $class = Classes::find($id);
        
        $class->name = $request->name;
        $class->admission_fees = $request->admission_fees;
        $class->monthly_fees = $request->monthly_fees;
        $class->save();
        return redirect()->route('admin.classes.index')->with('success','Class updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Classes::find($id)->delete();
       return redirect()->route('admin.classes.index')->with('success','Class deleted');
    }

    public function arrange_classes(){
        $arrange_class = ArrangeClass::latest()->get();
        return view('admin.arrange_class.index',compact('arrange_class'));
    }

    public function delete_arrange_classes($id){
        ArrangeClass::find($id)->delete();
        ClassAttendance::where('class_id',$id)->delete();
        return redirect()->back()->with('success','Class deleted');
    }

    public function view_participation(Request $request){
        $participation = ClassAttendance::where('class_id',$request->prop_id)
                        // ->where('role_id',4)
                        ->join('users','users.id','=','class_users.user_id')
                        ->get();
                        // dd($participation);
        return response()->json($participation);
    }


    public function getStudentsByClass(Request $request){
        $class_id = $request->class_id;
        $students_list = User::where('class',$class_id)->get();
        if ($students_list) {
            $message = 'success';
            $res = $students_list;
        }else{
            $message = 'error';
            $res = '';
        }
        return response()->json(array(
            'msg' 	    => $message,
            'result'	=> $res
        )); 
    }

    //Check monthly payment
    public function monthly_payment_check($id)
    {
        $course_details = SpecialCourse::find($id);
        $current_date = date('Y-m-d');
        $users = User::where('special_course_id',$id)->get();
        if ($users->count() > 0) {
            foreach ($users as $user) {
                $payment_details = Payment::where('user_id',$user->id)->orderBy('id', 'desc')->first();
                if ($payment_details) {
                        $payment_due_date = $payment_details->next_due_date;
                        $email_data['user_details'] = $user;
                        $email_data['payment_details'] = $payment_details;
                        if ($current_date > $payment_due_date) {
                            Notification::route('mail', $user->email)
                            ->notify(new PaymentDueNotification($email_data));
                        }
                }
            }
            return redirect()->back()->with('success','Email send successfully');
        }
        return redirect()->back()->with('error','No user yet not register with this course');
    }
}
