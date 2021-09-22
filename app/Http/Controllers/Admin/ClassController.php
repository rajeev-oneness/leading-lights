<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::latest()->get();
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
            'name' => 'required|string|max:255',
        ]);
      
        $class = new Classes();
        $class->name = $request->name;
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
        ]);

        $class = Classes::find($id);
        
        $class->name = $request->name;
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
}
