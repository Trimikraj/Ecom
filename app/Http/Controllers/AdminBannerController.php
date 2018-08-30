<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminBannerController extends Controller
{
    var $current = 'banner';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners=null;
        $param='';
        if ($request->has('search')){
            $param=$request->input('search');
            $params='%'.$param.'%';
            $banners=Banner::where('title','like',$params)
            ->orWhere('description','like',$params)->get();
        }else{
            $banners=Banner::all();
        }
        return view('admin.banners.index',[
            'banners'=>$banners,
            'param'=>$param,
            'current'=>$this->current
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create',[
            'current'=>$this->current
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $banner=new Banner();
        $banner->title=$request->input('title');
        $banner->description=$request->input('description');
        $banner->updated_at=null;
        $banner->status=$request->has('status');

        if($request->hasFile('image')){
            $request->file('image');
            $banner->image = Storage::putFile('public',$request->image);
        }else{
            $banner->image = 'public/default.jpg';
        }
        $banner->save();
        return redirect ('admin/banners');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit',[
            'banner'=>Banner::find($banner->id),
            'current'=>$this->current
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $banner->title=$request->input('title');
        $banner->description=$request->input('description');
        $banner->status=$request->has('status');

       if($request->hasFile('image')){
            $request->file('image');
            $banner->image = Storage::putFile('public',$request->image);
        }else{
            $banner->image = $banner->image;
        }
        $banner->save();
        return redirect ('admin/banners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect('admin/banners');
    }
}
