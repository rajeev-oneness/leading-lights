<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::where('role_id',3)->where('status',1)->latest()->get();
        return view('admin.course.create',compact('teachers'));
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
            'title' => 'required|string|max:255',
            'description' => 'required',
            'start_date' => 'date | required',
            'end_date' => 'date | required',
            'teacher_id' => 'required',
            'duration' => 'required|min:1',
            'fees' => 'required',
            'image' => 'mimes:png,jpg'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = imageUpload($image,'course');
        }else{
            $imageName = null;
        }

        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->teacher_id = $request->teacher_id;
        $course->duration = $request->duration;
        $course->fees = $request->fees;
        $course->image = $imageName;
        $course->save();
        return redirect()->route('admin.courses.index')->with('success','Course added');

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
        $data['course_details'] = Course::find($id);
        $data['teacher'] = User::where('id',$data['course_details']['teacher_id'])->first();;
        return view('admin.course.view')->with($data);
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
        $data['course_details'] = Course::find($id);
        $data['teachers'] = User::where('role_id',3)->where('status',1)->latest()->get();
        return view('admin.course.edit')->with($data); 
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
            'title' => 'required|string|max:255',
            'description' => 'required',
            'start_date' => 'date | required',
            'end_date' => 'date | required',
            'teacher_id' => 'required',
            'duration' => 'required|min:1',
            'fees' => 'required',
            'image' => 'mimes:png,jpg'
        ]);

        $course = Course::find($id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            if ($course->image) {
                $image_name = explode('/', $course->image)[2];
                if(File::exists('upload/course/'.$image_name)) {
                    File::delete('upload/course/'.$image_name);
                }
                
            }
            $imageName = imageUpload($image,'course');
        }else{
            $imageName = $course->image;
        }

        
        $course->title = $request->title;
        $course->description = $request->description;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->teacher_id = $request->teacher_id;
        $course->duration = $request->duration;
        $course->fees = $request->fees;
        $course->image = $imageName;
        $course->save();
        return redirect()->route('admin.courses.index')->with('success','Course details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::find($id)->delete();
        return redirect()->route('admin.courses.index')->with('success','Course deleted');
    }
}
