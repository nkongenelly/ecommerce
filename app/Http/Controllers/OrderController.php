<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Product;
use App\OrderStatus;
use App\OrderItems;
use App\Cart;
use Session;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    { 
        // $orders = Order::all();
      $orders = Order::where('user_id',$id)->get();
        // $visits = Order::where()
        //     ->join('order_items', 'order_items.product_id', '=', 'orders.product_id')
        //     ->join('products', 'products.product_id', '=', 'order_items.product_id')
        //     ->select('products.product_name', 'products.product_feature','products.product_description','products.product_price')
        //     ->get();
        //     // dd($visits);
        // dd($orders);
        foreach($orders as $order){
            $orderss = $order->product_id;
            $acb = $order->order_status_id;
            // dd(array($order));
            // dd($order->product_id);
            $productss = Product::where('id',$orderss)->get();
            // dd($productss);
           foreach($productss as $products){

            $product=$products->product_name;
            // dd($product);
           } 
        // dd($products->product_name);
       }
    //    dd($productss);
        return view('orders.indexBuyer',compact('orders','productss','products'));
        //}
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordersseller(){
        //Get Ordered products whose status are 2 for each user
        $user = auth()->user()->id;
        $orders = Order::where('order_status_id',2)->get();
        // $products =0;
        $count =0;
        foreach($orders as $order){
            if($order->order_status_id = 2){
                $buyers = $order->user_id;
                $buyer = auth()->user()->find($buyers)->name;
                $productss = $order->product_id;
                $products = Product::where([
                    'id'=>$productss,
                    'user_id'=>$user,
                    ])->get();
                foreach($products as $product){
                    
                }
            }
        }
        // dd($order->order_status_id);
        return view('orders.indexSeller',compact('orders','products','buyer'));

    }

    public function orderscomplete($id, $order){
        //update order_status to completed
        $statuss = 3;
        $status = Order::where('id',$order)
                        ->update([
                            'id' => $order,
                            'user_id' => $order,
                            'order_status_id' => $statuss,
                        ]);
        return $this->ordersseller();

    }

    public function orderview( $id, $order){
        $orderss = Order::where('id',$order)->select(['user_id'])->get();
        foreach($orderss as $orders){
            $single = $orders->user_id;
            $user = auth()->user($single)->name;   
            // dd($user);
        }
        $quantities = OrderItems::where('order_id',$order)->select(['quantity'])->get();
        foreach($quantities as $quantitys){
            $quantity = $quantitys->quantity;
            
        }
        $productss = Product::where('id',$id)->select(['product_name','product_price'])->get();
        foreach($productss as $products){
            $product = $products->product_name;
            $price =  $products->product_price;
            $created = $products->created_at;
            // dd($created);
        }
       
        return view('orders.orderSingleSeller',compact('user','quantity','product','price','order','id'));

    }

    public function ordersbuyer($id){
        $orders = DB::table('orders')->where([
            'user_id'=>$id,
            'order_status_id' =>2,
            ])->get();
        // $orders = Order::where('user_id',$id)->select('order_status_id')->get();
        // $products =0;
        $count =0;
        foreach($orders as $order){
            if($order->order_status_id = 2){
                $productss = $order->product_id;
                $products = Product::where('id',$productss)->get();
                foreach($products as $product){
                    $group = $product->product_name;
                    $abs = $products->groupBy($group);
                    foreach($abs as $abc){

                    }
                    // dd(boolean($order->order_status_id = 2));
                }
            }
        }
        
        // dd($orders->order_status_id);
        return view('orders.indexOBuyer',compact('orders','products'));

    }


    public function create($id)
    {

        $product = Product::find($id);
        // dd($id);
        $status = 1;
        $orderstatus = OrderStatus::find($status);
        // dd($product);
        return view('orders.createBuyer',compact('product','orderstatus','id'));
    }

    public function cart(Request $request,$id, $product)
    {
        $status = 1;
        Order::create([
            'user_id' => $id,
            'order_status_id' =>$status,
            'product_id' =>$product,
        ]);
         session()->flash("success_message", "you have successfully added Product to your Cart");
        
        // dd('orderstatusd');
        return redirect('/productsbuyer');
    }

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);

        $user = auth()->user()->id;
        $status = 1;
        Order::create([
            'user_id' => $user,
            'order_status_id' =>$status,
            'product_id' =>$id,
        ]);
        return redirect('/productsbuyer');
    }

    public function getCart(){
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
      $carts = $cart->items;
      foreach($cart->items as $item){
          $productss = $item['item']->id;
        $orders = Order::where('product_id',$productss)->get();
        foreach($orders as $order){
            // dd($order->order_status_id);
        }
      }
      foreach($carts as $product){
        $productss = $product['product_id'];
        $products=Product::find($productss);
        $users = auth()->user()['id'];
        
      }
      return view('orders.indexBuyer',['products' => $cart->items, 'totalPrice' => $cart->totalPrice],compact('orders'));
        // return view('orders.indexBuyer', compact('order','products'));
    }


    //     $users = auth()->user()->id;
    //     $orders = Order::where('user_id',$users)->get();
    //     // $visits = Order::where()
    //     //     ->join('order_items', 'order_items.product_id', '=', 'orders.product_id')
    //     //     ->join('products', 'products.product_id', '=', 'order_items.product_id')
    //     //     ->select('products.product_name', 'products.product_feature','products.product_description','products.product_price')
    //     //     ->get();
    //     //     // dd($visits);
    //     // dd($orders);
    //     foreach($orders as $order){
    //         $orderss = $order->product_id;
    //         $acb = $order->order_status_id;
    //         // dd(array($order));
    //         // dd($order->product_id);
    //         $productss = Product::where('id',$orderss)->get();
    //         // dd($productss);
    //        foreach($productss as $products){

    //         $product=$products->product_name;
    //         // dd($product);
    //        } 
    //     // dd($products->product_name);
    //    }
    // //    dd($productss);
    //     return view('orders.indexBuyer',compact('orders','productss','products'));
        //}
        
       
    //}
    

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
        $abcd = Order::create(request([
            'user_id','order_status_id','product_id'
        ]))->orderBy('created_at','desc')->first()->id;
        // dd($abcd);
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
            // dd(array('product_id'=>request(['product_id'])));
        }
        // $result = array (json_encode(orderitem),'product_id','');
        // dd($orderitem);
        // $orders = Order::find();
        // foreach($result as $orderitems){
        //     $orderitem = $orderitems->id;
        $ab = array(
            'order_id'=>json_encode($abcd),
            request(['product_id']),
            request(['quantity']),
            'price'=>json_encode($pricesss),
        );
        // dd(request(['product_id','quantity']));
        // dd(request(['product_id'])['product_id']);
        OrderItems::create(array(
            'order_id'=>json_encode($abcd),
            'product_id'=>request(['product_id'])['product_id'],
            'quantity'=>request(['quantity'])['quantity'],
            'price'=>json_encode($pricesss),
            ));
            // dd('okay');
            // dd($abc);
        // }
            // dd($abc);
            // $orders = Order::all();
            $orders = Order::where('user_id',request(['user_id'])['user_id'])->get();
              foreach($orders as $order){
                  $orderss = $order->product_id;
                  $productss = Product::where('id',$orderss)->get();
             }

            //  return view('orders.indexBuyer',compact('orders','productss','products'));
             $user =request(['user_id']);
            return $this->ordersbuyer($user);
            // return redirect('/ordersbuyer/{{ Auth::user()["id"] }}');
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
