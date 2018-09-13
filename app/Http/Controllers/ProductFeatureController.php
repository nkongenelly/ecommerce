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
    public function create($id)
    {
        $product = Product::find($id);
        $user = auth()->user();
        $features = Feature::all();
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
        return redirect('/products/{{ Auth::user()->id  }}');
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
        
        $featuress = DB::table('features')->select(['id','feature_name'])->get()->toArray();
        $featuresss = count($featuress);
        // dd($featuress);
        
        // dd(Feature::all());
        // // $productfeatures = ProductFeature::all();
        // $productfeatures = ProductFeature::where('product_id',$id)->select('product_id','feature_id');
        return view('products.featurepEdit',compact(['productfeature','featuresss','features','featuress','user']));
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
        // dd($id);
        DB::table('feature_product')
            ->where('id', $id)
            ->delete();

            // dd($id);
            $user = auth()->user()->id;
            $products = Product::where('user_id',$user)->get();
        // dd($products);
        return view('products.indexP',compact('products'));
    }
}
