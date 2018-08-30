<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    var $current = 'category';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories=null;
        $param='';
        if ($request->has('search')){
            $param=$request->input('search');
            $params='%'.$param.'%';
            $categories=Category::where('name','like',$params)
            ->orWhere('description','like',$params)->get();
        }else{
            $categories=Category::orderBy('display_order', 'asc')->get();
        }
        return view('admin.categories.index',[
            'categories'=>$categories,
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
         return view('admin.categories.create',[
            'current'=>$this->current
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category=new Category();
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        $category->display_order=$request->input('display_order');
        $category->meta_description=$request->input('meta_description');
        $category->meta_keywords=$request->input('meta_keywords');
        $category->updated_at=null;
        $category->status=$request->has('status');

        if($request->hasFile('image')){
            $request->file('image');
            $category->image = Storage::putFile('public',$request->image);
        }else{
            $category->image = 'public/default.jpg';
        }
        $category->save();
        return redirect ('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',[
            'category'=>Category::find($category->id),
            'current'=>$this->current
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request,Category $category)
    {
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        $category->display_order=$request->input('display_order');
        $category->meta_description=$request->input('meta_description');
        $category->meta_keywords=$request->input('meta_keywords');
        $category->status=$request->has('status');

       if($request->hasFile('image')){
            $request->file('image');
            $category->image = Storage::putFile('public',$request->image);
        }else{
            $category->image = $category->image;
        }
        $category->save();
        return redirect ('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('admin/categories');
    }
}
