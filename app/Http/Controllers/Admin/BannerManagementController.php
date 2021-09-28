<?php

namespace App\Http\Controllers\Admin;

use App\Models\CMS;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BannerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Banner::latest()->get();
        return view('admin.banner.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'image' => 'required| mimes:png,jpg',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = imageUpload($image,'cms');
        }else{
            $imageName = null;
        }
        $banner = new Banner();
        $banner->name = $request->name;
        $banner->image = $imageName;
        $banner->status = 1;
        $banner->save();
        return redirect()->route('admin.banner.index')->with('success','Banner created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_details = Banner::find($id);
        return view('admin.banner.view',compact('page_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_details = Banner::find($id);
        return view('admin.banner.edit',compact('page_details'));
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
            'image' => 'nullable | mimes:png,jpg',
        ]);
        $page = Banner::find($id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = explode('/', $page->image)[2];
            if(File::exists('upload/banner/'.$image_name)) {
                File::delete('upload/banner/'.$image_name);
            }
            $imageName = imageUpload($image,'banner');
        }else{
            $imageName = $page->image;
        }
        $page->name = $request->name;
        $page->image = $imageName;
        $page->status = $request->status;
        $page->save();
        return redirect()->route('admin.banner.index')->with('success','Banner updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::find($id)->delete();
        return redirect()->route('admin.banner.index')->with('success','Banner deleted');
    }
}
