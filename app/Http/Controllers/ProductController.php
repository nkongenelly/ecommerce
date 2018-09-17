<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\User;
use App\Feature;
use App\Review;
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
        $user = auth()->user()->find($id);
        // $products = Product::where('user_id',$user);
        $products = Product::where('user_id',$id)->get();
     
        // dd($products);
        return view('products.indexP',compact('user','products'));
    }
public $archives;
public $countproducts;
// public $archives;
// public $archives;
    public function indexBuyer(Request $request)
    { 
        $products = Product::where([
                            ['product_status','1'],
                            ['Product_quantity','>','0'],
                            ])
                             ->get(); 
                            //  dd($products);
        if($category_id = request('category_name')){
            $productss = Category::find($category_id);
        $products = $productss->products;
        // dd($products);
        }
        foreach($products as $product){
            $category = $product->category_id;
            // $countproducts = Product::where('category_id',$category)->count();
            // $archives = Category::find($category);
            $archives = Category::all();
        }
        return view('products.indexpBuyer',compact('products','archives','productss'));
        
    } 
            // dd($category);
            // foreach($archives as $archive){
            //     // dd($countproducts);
            //     $products = Product::where([
            //         ['product_status','1'],
            //         ['Product_quantity','>','0'],
            //         ])
            //          ->get(); 
            //         //  dd($products);
                
            //     if($category_name = request('category_name')){

            //     $category = Category::where('category_name',$category_name)->get();

            //         $categoryid = $archive->id;
            //         $products = $archive->products;
            //         // dd($products);
            //         $products = $products;
            //     }
           // }
        
            
                
            
            //  dd($archive->products->count());
            // $products = Product::latest();
            // if($category_name = request('category_name')){
            //     $products =$category_name->products;
            //     // $products = $products->get();
            // }
            // }
            // $category = Category::latest();
            // if($category_name = request('category_name')){
                
            //     $category = Category::where('category_name',$category_name)->get();
            //     foreach($archives as $categorys)  {
            //         $categoryid = $categorys->id;
            //         $products = $categorys->products;
            //         // dd($products);
            //         $products = $products;
            //     }
               
            //  }
            
    //         return view('products.indexpBuyer',compact('products','archives','productss'));
        
    // } 
            // $products = $products->get();
            // dd($category);
            // $archivesss = Category::select('category_name')
            //     ->get();
            
            //     foreach($archivesss as $archive){
            //         $productsmatch = Product::where('category_id',$archive)->get();
            //         foreach($productsmatch as $matched){
            //             if(($matched->Product_quantity)>0){
            //                 $archivess = Category::select('category_name');
            //                 // dd($archivess);
            //             }
            //         }
            //     }
            //     // $archives = Category::select('category_name')
            //     // ->get();

            // //get products whose status is 1 (in stock)
    public function reviewsbuyerindex(){
        $reviews = Review::all();
        return view('products.reviewIndexBuyer',compact('reviews'));
    }
                    
    public function reviewsbuyer($id){
       $product =Product::find($id); 
        return view('products.reviewsbuyer',compact('product'));
    }

    public function reviewsbuyerdestroy($review,$user){

        $destroy =Review::where([
            'user_id'=>$user,
            'id'=>$review
            ])
            ->delete();

        $reviews = Review::all();
         return view('products.reviewIndexBuyer',compact('reviews'));
     }

    public function reviewsseller($id){
        $products = Product::where('user_id',$id)->get();
        foreach($products as $product){
            $reviews = $product->reviews;
        }

        return view('products.reviewIndexSeller',compact('reviews'));
     }

    public function reviewsbuyerstore(Request $request){
        // dd(request(['review','product_id','user_id']));
        $this->validate(request(),[
            'review'=>'required',
            'product_id'=>'required',
            'user_id'=>'required'
        ]);
        Review::create(request(['review','product_id','user_id']));
        $reviews = Review::all();
        return view('products.reviewIndexBuyer',compact('reviews'));
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
        //dd($request->all());
        // dd(request(['product_name','product_status','product_price','user_id','category_id','product_description','Product_quantity']));
        $this->validate(request(),[
            'product_name' => 'required',
            'product_status' => 'required',
            'product_price' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'product_description' => 'required',
            'Product_quantity' => 'required',
        ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_status = $request->product_status;
        $product->product_price = $request->product_price;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->product_description = $request->product_description;
        $product->Product_quantity = $request->Product_quantity;

        $product->save();
        
        //Product::create(request(['product_name','product_status','product_price','user_id','category_id','product_description','Product_quantity']));
         //    dd('Hallo');
        //    return redirect('/categories');
        $user = auth()->user()->id;
        // $products = Product::where('user_id',$user);
        $products = Product::where('user_id',$user)->get();
     
        // dd($products);
        return view('products.indexP',compact('user','products'));
        
        //return view('products.indexP',compact('user','products'));
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function features(Request $request,$id)
    {

        $product = Product::where('user_id',auth()->user()->id)->find($id);
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
        
        $productss = Product::where('id',$id)
            ->delete();
        $user = auth()->user()->id;
        $products = Product::where('user_id',$user)->get();
        
        return view('products.indexP',compact('user','products'));
    }
}
