<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Brand;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    var $current = 'product';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $products=null;
        $param='';
        if ($request->has('search')){
            $param=$request->input('search');
            $params='%'.$param.'%';
            $products=Product::where('name','like',$params)
            ->orWhere('description','like',$params)->get();
        }
        elseif ($request->has('category')) {
            foreach($request->input('category') as $c){
                //$products=Product::where('category_id','like',$c)->orWhere('category_id','like',$c);
                print_r($c);
                exit;
            }
            //$products=$products->get();
        }
        elseif ($request->has('banner')) {
            foreach($request->input('banner') as $b){
                //$products=Product::where('category_id','like',$c)->orWhere('category_id','like',$c);
                print_r($b);
                exit;
            }
            //$products=$products->get();
        }
        else{
            $products=Product::all();
        }
        return view('admin.products.index',[
            'products'=>$products,
            'param'=>$param,
            'category'=>Category::all(),
            'brand'=>Brand::all(),
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
        return view('admin.products.create',[
            'category'=>Category::all(),
            'brand'=>Brand::all(),
            'current'=>$this->current
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product=new Product();
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->quantity=$request->input('quantity');
        $product->price=$request->input('price');
        $product->category_id=$request->get('category');
        $product->brand_id=$request->get('brand');
        $product->display_order=$request->input('display_order');
        $product->meta_description=$request->input('meta_description');
        $product->meta_keywords=$request->input('meta_keywords');
        $product->updated_at=null;
        $product->status=$request->has('status');

        if($request->hasFile('image')){
            $request->file('image');
            $product->image = Storage::putFile('public',$request->image);
        }else{
            $product->image = 'public/default.jpg';
        }
        $product->save();
        return redirect ('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit',[
            'product'=>Product::find($product->id),
            'category'=>Category::all(),
            'brand'=>Brand::all(),
            'current'=>$this->current
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->quantity=$request->input('quantity');
        $product->price=$request->input('price');
        $product->category_id=$request->input('category');
        $product->brand_id=$request->input('brand');
        $product->display_order=$request->input('display_order');
        $product->meta_description=$request->input('meta_description');
        $product->meta_keywords=$request->input('meta_keywords');
        $product->status=$request->has('status');

       if($request->hasFile('image')){
            $request->file('image');
            $product->image = Storage::putFile('public',$request->image);
        }else{
            $product->image = $product->image;
        }
        $product->save();
        return redirect ('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('admin/products');
    }
}
