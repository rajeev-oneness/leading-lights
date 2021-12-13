<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpecialCourse;
use Illuminate\Support\Facades\Validator;

class SpecialCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = SpecialCourse::latest()->get();
        return view('admin.special_course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::orderBy('name')->get();
        return view('admin.special_course.create',compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            // 'class_id' => 'required',
            'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'fees' => 'required | min:1',
        ], $messages = [
            'title.required' => 'The course title field is required.',
            'title.unique' => 'The course title  must  be unique',
            // 'class_id.required' => 'Please choose available class',
        ])->validate();

        $courses = new SpecialCourse();
        $courses->title = $request->title;
        if ($request->class_id) {
            $courses->class_id = $request->class_id;
        }else{
            $courses->class_id = null;
        }
        $courses->start_date = $request->start_date;
        // $courses->end_date = $request->end_date;
        $courses->monthly_fees = $request->fees; 
        $courses->save();
        return redirect()->route('admin.special-courses.index')->with('success','Course added successful');
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
        $data['course_details'] = SpecialCourse::find($id);
        $data['classes'] = Classes::latest()->get();
        return view('admin.special_course.edit')->with($data);
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
        Validator::make($request->all(), [
            'title' => 'required',
            // 'class_id' => 'required',
            'start_date' => 'required|date',
            // 'end_date' => 'required|date',
            'fees' => 'required | min:1',
        ], $messages = [
            'title.required' => 'The course title field is required.',
            'title.unique' => 'The course title  must  be unique',
            // 'class_id.required' => 'Please choose available class',
        ])->validate();

        $courses = SpecialCourse::find($id);
        $courses->title = $request->title;
        if ($request->class_id) {
            $courses->class_id = $request->class_id;
        }else{
            $courses->class_id = null;
        }
        
        $courses->start_date = $request->start_date;
        // $courses->end_date = $request->end_date;
        $courses->monthly_fees = $request->fees; 
        $courses->save();
        return redirect()->route('admin.special-courses.index')->with('success','Course details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
