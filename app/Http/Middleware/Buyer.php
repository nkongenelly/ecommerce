<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Product;
use App\Category;
use Illuminate\Http\Response;

class Buyer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && $request->user()->usertype_id == '1'){
            // return redirect('home')->with('error','You do not have admin access');$products = Product::where('product_status','1')
            $products = Product::where([
                ['product_status','1'],
                ['Product_quantity','>','0'],
                ])
                 ->get(); 
                //  dd($products);
                foreach($products as $product){
                    $category = $product->category_id;
                    $archives = Category::find($category);
                    $category = Category::latest();
                    if($category_name = request('category_name')){
                        
                        $category = Category::where('category_name',$category_name)->get();
                        foreach($archives as $categorys)  {
                            $categoryid = $categorys->id;
                            $products = Product::where('category_id',$categoryid)->get(); 
                        }
                    }
                    return new Response(view('products.indexpBuyer',compact('products','archives'))->with('role','BUYER'));
                }
            
            // return new Response(view('unauthorised access'->with('user_type','ADMIN'));
        }
        return new Response(view('unauthorized')->with('role','BUYER'));
    }
    
}
