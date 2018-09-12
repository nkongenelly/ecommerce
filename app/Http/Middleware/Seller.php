<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Category;
use App\Product;
use Illuminate\Http\Response;

class Seller
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
        if($request->user() && $request->user()->usertype_id == '3'){
            $products = Product::all();
            // return redirect('home')->with('error','You do not have admin access');
            return new Response(view('products.indexP',compact('products'))->with('role','SELLER'));
        }
        return new Response(view('unauthorized')->with('role','SELLER'));
        // return $next($request); 
    }
}
