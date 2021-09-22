<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VLOG;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vlogs = VLOG::latest()->get();
        return view('admin.vlog.index',compact('vlogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vlog.create');
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
            'title' => 'required',
            'video_url' => 'required',
            'video_content' => 'required'
        ]);

        $vlog = new VLOG();
        $vlog->title = $request->title;
        $vlog->video_url = $request->video_url;
        $vlog->video_content = $request->video_content;
        $vlog->user_id = Auth::user()->id;
        $vlog->status = 1;
        $vlog->save();
        return redirect()->route('admin.vlog.index')->with('success','Vlog created successfully');
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
        $vlog_details = VLOG::find($id);
        return view('admin.vlog.edit',compact('vlog_details'));
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
            'title' => 'required',
            'video_url' => 'required',
            'video_content' => 'required'
        ]);

        $vlog = VLOG::find($id);
        $vlog->title = $request->title;
        $vlog->video_url = $request->video_url;
        $vlog->video_content = $request->video_content;
        $vlog->user_id = Auth::user()->id;
        $vlog->status = 1;
        $vlog->save();
        return redirect()->route('admin.vlog.index')->with('success','Vlog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VLOG::find($id)->delete();
        return redirect()->route('admin.vlog.index')->with('success','Vlog deleted successfully');
    }
}
