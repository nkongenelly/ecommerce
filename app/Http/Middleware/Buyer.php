<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Product;
use App\Category;
use Session;
use App\Cart;
use App\Order;
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
                        if(array($products)){
                        if($category_id = request('category_name')){
                        $productss = Category::find($category_id);
                        $products = $productss->products;
                        // dd($products);
                        }
                        foreach($products as $product){
                        $category = $product->category_id;
                        // $countproducts = Product::where('category_id',$category)->count();
                        // $archives = Category::find($category);
                        }
                    }
                        $archives = Category::all();
                        $oldCart = Session::has('cart') ? Session::get('cart') : null;
                        $cart = new Cart($oldCart);
                        $request->session()->put('cart', $cart);
                        // dd($cart);
                        $orderid =0;
                        if($cart->items !=null){
                            foreach($cart->items as $item){
                                $orderid1 = $item['order_id'];
                            }
                            $orderid = $orderid1;
                            return new Response(view('products.indexpBuyer',compact('products','archives','productss','cart','orderid'))->with('role','BUYER'));
                        }else{
                            $allorders= Order::latest();
                            foreach($allorders as $oneorder){
                                $orderid = $oneorder->id;
                            }
                            // $orderid = $orderid2;
                            return new Response(view('products.indexpBuyer',compact('products','archives','productss','cart','orderid'))->with('role','BUYER'));
                        }
                    // return new Response(view('products.indexpBuyer',compact('products','archives','productss','cart','orderid'))->with('role','BUYER'));
                }
            
            // return new Response(view('unauthorised access'->with('user_type','ADMIN'));
        
        return new Response(view('unauthorized')->with('role','BUYER'));
    }
    
}
