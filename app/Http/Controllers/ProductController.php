<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\User;
use App\Feature;
use App\ProductFeature;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.indexP',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $user = auth()->user();
        return view('products.createP',compact('categories','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'category_id' => 'required',
            'user_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
        ]);
        

        Product::create(request(['product_name','product_price','product_description','user_id','category_id']));

        return redirect('/products');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function features(Request $request,$id)
    {
        $product = Product::find($id);
        $productfeatures = ProductFeature::where('product_id',$id)->select('product_id','feature_id');
        $features = Feature::find($id);
        // dd(Feature::all());
        // $productfeatures = ProductFeature::all();
        $productfeatures = ProductFeature::where('product_id',$id)->select('product_id','feature_id');
        return view('products.featureCreate',compact(['product','features'.'productfeatures']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $user = auth()->user();
        return view('products.editP',compact('product','categories','user'));
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
        $this->validate(request(),[
            'category_id' => 'required',
            'user_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
        ]);

        Product::where('id',$id)
                ->update(request(['product_name','product_price','product_description','user_id','category_id']));

                return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)
            ->delete();
            return redirect('/products');
    }
}
