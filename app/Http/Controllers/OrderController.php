<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderStatus;
use App\OrderItems;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    { 
      $orders = Order::where('user_id',$id)->get();
      foreach($orders as $order){
         $order=($order->order_status_id);
        }
        // $visits = Order::where()
        //     ->join('order_items', 'order_items.product_id', '=', 'orders.product_id')
        //     ->join('products', 'products.product_id', '=', 'order_items.product_id')
        //     ->select('products.product_name', 'products.product_feature','products.product_description','products.product_price')
        //     ->get();
        //     // dd($visits);
        foreach($orders as $order){
            $orderss = $order->product_id;
            // dd($order->product_id);
            $productss = Product::where('id',$orderss)->get();
           foreach($productss as $products){

            $product=$products->product_name;
            // dd($product);
           } 
        // dd($products->product_name);
       }
        return view('orders.indexBuyer',compact('orders','productss','products'));
        //}
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $product = Product::find($id);
        // dd($id);
        $status = 1;
        $orderstatus = OrderStatus::find($status);
        // dd($product);
        return view('orders.createBuyer',compact('product','orderstatus','id'));
    }

    public function cart($id, $product)
    {
        $status = 1;
        Order::create([
            'user_id' => $id,
            'order_status_id' =>$status,
            'product_id' =>$product,
        ]);
        session()->flash("add_to_cart", "You have successfully added a product in your cart");
        
        // dd('orderstatusd');
        return redirect('/productsbuyer');
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
            'user_id' => 'required',
            'order_status_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        Order::create(request([
            'user_id','order_status_id','product_id'
        ]));
        // $orderitems = request(['user_id','order_status_id','product_id','quantity']);
        $result = Order::where('order_status_id',request(['order_status_id'] )&& 'user_id',request(['user_id']) )->select('id')->get();
        // dd($orderitems);
        $prices = $request->product_id;
        $pricess = Product::find($prices);
        $pricesss = $pricess->product_price;
        // dd($pricesss);
        $price = $request->price=$pricesss;
        // $result = $results['user_id'];
        // $orderitems = OrderItems::where('id', $result)->select('id')->get();
        // dd($result);
        foreach($result as $orderitems){
            $orderitem = $orderitems->id;
        }
        // dd($orderitem);
        // $orders = Order::find();
        $abc= OrderItems::create(array(
            'order_id'=>json_encode($orderitem),
            'product_id'=>request(['product_id']),
            'quantity'=>request(['quantity']),
            'price'=>json_encode($pricesss),
            ));
            dd($abc);
            $orders = Order::all();
            return view('orders.indexBuyer',compact('orders'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
