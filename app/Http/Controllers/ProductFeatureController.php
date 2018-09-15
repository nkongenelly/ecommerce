<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Feature;
use App\FeatureProduct;

class ProductFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $user)
    {
        $product = Product::find($id);
        // $user = auth()->user()->id;
        $features = Feature::where('user_id',$user)->get();
        // $features = $product->features;
        // $features = Feature::find($product);
        // dd($user);
        
        // // dd(Feature::all());
        // // $productfeatures = ProductFeature::all();
        // $productfeatures = ProductFeature::where('product_id',$id)->select('product_id','feature_id');
        return view('products.featureCreate',compact(['product','features','user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate(request(),[
            'product_id' => 'required',
            'feature_id' => 'required',
        ]);
        // $features= Feature::find(request('feature__id'));
        // $products= Product::find(request('product__id'));
            // dd('features');
        // $features->products()->attach($products);
        DB::table('feature_product')->insert(request(['product_id','feature_id']));
        
        // FeatureProduct::create(request(['product_id','feature_id']));
        // $product = Product::find($id);
        // // dd($product);
        // $user = auth()->user();
        // $features = $product->features();
        // $user = auth()->user($id);
        // $products = Product::where('user_id',$user);
        // $products = Product::where('user_id',$id)->get();
        // dd($products);
        $product = Product::find($id);
        
        $user = auth()->user();
        $features = $product->features;
        return view('products.featurepIndex',compact(['product','features','user']));
        // return redirect('/products/{{ Auth::user()->id  }}');
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
        $productfeatures = DB::table('feature_product')->where('product_id',$id)->get()->toArray();;

        // $productfeatures =FeatureProduct::where('id',$id)->get()->toArray();
        // dd($productfeatures[0]->id);
        $productfeature = $productfeatures[0];
        // dd($productfeature);

        $featuress = $productfeature->feature_id;
        // $products = Product::where('id',$id)->get()->toArray();
        // $product = $products[0];
        //    dd($features);
        $user = auth()->user();
        // $features = $product->features;
        
        $features = Feature::find($featuress);
        // dd($features->id);
        // $featuresss = Feature::where('id',$feature)->get()->toArray();
        $featuresall = Feature::all();
        $featuress = DB::table('features')->select(['id','feature_name'])->get()->toArray();
        $featuresss = count($featuress);
        // dd($featuress);
        
        // dd(Feature::all());
        // // $productfeatures = ProductFeature::all();
        // $productfeatures = ProductFeature::where('product_id',$id)->select('product_id','feature_id');
        return view('products.featurepEdit',compact(['productfeature','featuresss','features','featuress','user','featuresall']));
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
        // dd($id);
        $this->validate(request(),[
            'product_id' => 'required',
            'feature_id' => 'required',
        ]);

        DB::table('feature_product')
            ->where('id', $id)
            ->update(request(['product_id','feature_id']));


            $user = auth()->user()->id;
            $products = Product::where('user_id',$id)->get();
            $id = request(['product_id'])['product_id'];
            $product = Product::find($id);
        
            $user = auth()->user();
            $features = $product->features;

            return view('products.featurepIndex',compact(['product','features','user']));
            // return view('products.indexP',compact('user','products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$feature)
    {
        // $ids = DB::table('feature_product')->where('product_id',$id)->get(); dd($ids);
        //     $id = $ids->product_id;
            $product = Product::find($id);
        
            $user = auth()->user();
            $features = $product->features;
        DB::table('feature_product')
            ->where([
                    'product_id'=> $id,
                    'feature_id'=> $feature,
                    ])
            ->delete();

            // dd($id);
            
            return view('products.featurepIndex',compact(['product','features','user']));
    }
}
