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
    public function index()
    {
        $user = auth()->user()->id;
        $orders = Order::where('user_id',$user)->get();
        $orderitems = OrderItems::all();
        dd($orders);
        return view('orders.indexBuyer',compact('orders','$orderitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::find($id);
        $status = 1;
        $orderstatus = OrderStatus::find($status);
        // dd($orderstatus->id);
        return view('orders.createBuyer',compact('product','orderstatus'));
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
           
           $prices = $request->product_id;
           $pricess = Product::find($prices);
           $pricesss = $pricess->product_price;
           $price = $request->price=$pricesss;
;        Order::create(request([
            'user_id','order_status_id'
        ]));
        $orders = Order::find();
        OrderItems::create([
            // 'order_id'=>'',
            'product_id'=>request('product_id'),
            'product_id'=>request('product_id'),
            'quantity'=>request('product_id'),
            'price'=>$pricesss*request('product_id'),]);
            // dd($request->price=$pricesss);
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
