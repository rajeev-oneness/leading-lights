<?php

namespace App\Http\Controllers\Admin;

use App\Models\CMS;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CMSPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = CMS::latest()->get();
        return view('admin.cms_page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms_page.create');
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
            'page_title' => 'required|string|max:255',
            'page_content' => 'required',
            'image' => 'nullable | mimes:png,jpg',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = imageUpload($image,'cms');
        }else{
            $imageName = null;
        }
        $cms = new CMS();
        $cms->page_title = $request->page_title;
        $cms->page_slug = Str::slug($request->page_title,'-');
        $cms->page_content = $request->page_content;
        $cms->image = $imageName;
        $cms->status = 1;
        $cms->save();
        return redirect()->route('admin.cms.index')->with('success','Page created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_details = CMS::find($id);
        return view('admin.cms_page.view',compact('page_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_details = CMS::find($id);
        return view('admin.cms_page.edit',compact('page_details'));
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
            'page_title' => 'required|string|max:255',
            'page_content' => 'required',
            'image' => 'nullable | mimes:png,jpg',
        ]);

        $page = CMS::find($id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = explode('/', $page->image)[2];
            if(File::exists('upload/cms/'.$image_name)) {
                File::delete('upload/cms/'.$image_name);
            }
            $imageName = imageUpload($image,'cms');
        }else{
            $imageName = $page->image;
        }

        $page->page_title = $request->page_title;
        $page->page_content = $request->page_content;
        $page->image = $imageName;
        $page->status = $request->status;
        $page->save();
        return redirect()->route('admin.cms.index')->with('success','Page details edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CMS::find($id)->delete();
        return redirect()->route('admin.cms.index')->with('success','Page details deleted');
    }
}
