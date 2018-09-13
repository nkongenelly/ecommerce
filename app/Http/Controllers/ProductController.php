<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\User;
use App\Feature;
use App\FeatureProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __constructor(){
    //     $this->middleware('seller');
    // }
    public function index($id)
    {
        $user = auth()->user($id);
        // $products = Product::where('user_id',$user);
        $products = Product::where('user_id',$id)->get();
        // dd($products);
        return view('products.indexP',compact('user','products'));
    }

    public function indexBuyer()
    {
        //get products whose status is 1 (in stock)
        $products = Product::where('product_status','1')
                ->get();
                // dd($products);
            return view('products.indexpBuyer',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function create()
    {
        // dd("hallo");
        $categories = Category::all();
        $user = auth()->user();
        // dd($user);
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
            'product_status' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
        ]);
        
        // dd('hello');
        Product::create(request(['product_name','product_status','product_price','product_description','user_id','category_id']));

        $user = auth()->user()->id;
        // $products = Product::where('user_id',$user);
        $products = Product::where('user_id',$user)->get();
        // dd($products);
        return view('products.indexP',compact('user','products'));
        

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
        // dd($product);
        $user = auth()->user();
        //get the feature_products table related to the clicked product to display their related text
        // $featureproduct = DB::table('feature_product')->where('product_id',$id)->select('feature_id')->get();
        // foreach($featureproduct){
        //     $features=
        // }
       //find the feature row(s) with that feature_id from feature table
        // $feature = Feature::where()
        // $features = Feature::all();
        $features = $product->features;
    //    foreach($product->features as $role){
        
    //     echo $role->feature_name;
    //    }
       
        // $featureproduct = DB::table('feature_product')->where('product_id',$id)->get();
        // $featureproduct = FeatureProduct::where('product_id',$id)->select();
        // $features = $featureproduct->feature_id;
        // dd($featureproduct->feature_id);
        // $features = $features->products()->attach($product);
        // dd($features->id);
        // $productfeatures = DB::table('feature_product')->get();
        // $productfeatures = $productfeaturess[0];
        // dd($productfeatures);
        // $productfeatures = ProductFeature::where('product_id',$id)->select('product_id','feature_id');
        return view('products.featurepIndex',compact(['product','features','user']));
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
        // dd($product->product_name);
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
        // dd(request(['category_id']));
        $this->validate(request(),[
            'category_id' => 'required',
            'user_id' => 'required',
            'product_name' => 'required',
            'product_status' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
        ]);
      
        Product::where('id',$id)
                ->update(request(['product_name','product_status','product_price','product_description','user_id','category_id']));

        $user = auth()->user()->id;
        $products = Product::where('user_id',$user)->get();
        return view('products.indexP',compact('user','products'));
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
