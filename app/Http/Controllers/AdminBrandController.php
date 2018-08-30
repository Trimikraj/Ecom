<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    var $current = 'brand';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands=null;
        $param='';
        if ($request->has('search')){
            $param=$request->input('search');
            $params='%'.$param.'%';
            $brands=Brand::where('name','like',$params)
            ->orWhere('description','like',$params)->get();
        }else{
            $brands=Brand::all();
        }
        return view('admin.brands.index',[
            'brands'=>$brands,
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
        return view('admin.brands.create',[
            'current'=>$this->current
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand=new Brand();
        $brand->name=$request->input('name');
        $brand->description=$request->input('description');
        $brand->updated_at=null;
        $brand->status=$request->has('status');

        if($request->hasFile('image')){
            $request->file('image');
            $brand->image = Storage::putFile('public',$request->image);
        }else{
            $brand->image = 'public/default.jpg';
        }
        $brand->save();
        return redirect ('admin/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',[
            'brand'=>Brand::find($brand->id),
            'current'=>$this->current
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->name=$request->input('name');
        $brand->description=$request->input('description');
        $brand->status=$request->has('status');

       if($request->hasFile('image')){
            $request->file('image');
            $brand->image = Storage::putFile('public',$request->image);
        }else{
            $brand->image = $brand->image;
        }
        $brand->save();
        return redirect ('admin/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect('admin/brands');
    }
}
