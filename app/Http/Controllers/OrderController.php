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
        // $orders = Order::where('order_status_id',2)->get();
        // $products =0;
        $orders = Order::join('products', 'products.id', '=', 'orders.product_id')
                    ->join('users','users.id', '=', 'orders.user_id')
                    ->where('products.user_id',$user)
                    ->join('order_items','order_items.order_id', '=', 'orders.id')
                    // ->join('order_items','order_items.product_id', '=', 'products.id')
                    ->where('orders.order_status_id',2)
                    ->select('products.product_name', 'products.product_description','orders.id','order_items.price','users.name','orders.product_id')
                    
                    ->get();
                    
                    // $buyer = auth()->user()->find($orders['user_id'])->name;dd($buyer);
        // $count =0;
        // foreach($orders as $order){
        //     if($order->order_status_id = 2){
        //         $buyers = $order->user_id;
        //         $buyer = auth()->user()->find($buyers)->name;
        //         $productss = $order->product_id;
        //         $products = Product::where([
        //             'id'=>$productss,
        //             'user_id'=>$user,
        //             ])->get();
        //         foreach($products as $product){
                    
        //         }
        //     }
        // }
        // dd($order->order_status_id);
        return view('orders.indexSeller',compact('orders','products','buyer'));

    }

    public function orderscomplete($id, $order){
        //update order_status to completed
        $statuss = 3;
        $status = Order::where('id',$order)
                        ->update([
                            'id' => $order,
                            'user_id' => $id,
                            'order_status_id' => $statuss,
                        ]);
        return $this->ordersseller();

    }

    public function orderview( $id, $order){
        // dd($id);
        $orderss = Order::where('id',$order)->select(['user_id'])->get();
        foreach($orderss as $orders){
            $userid = $orders->user_id;
            $userss = auth()->user()->where('id',$userid)->get(); 
            foreach($userss as $users){
                $user = $users->name;
                // dd($userid);
            }
            // $userid = auth()->user($single)->id;  
            
        }
        $quantities = OrderItems::where('order_id',$order)->select(['quantity','price'])->get();
        foreach($quantities as $quantitys){
            $quantity = $quantitys->quantity;
            $price =  $quantitys->price;
            // dd($quantity);
        }
        $productss = Product::where('id',$id)->select(['product_name','product_price'])->get();
        foreach($productss as $products){
            $product = $products->product_name;
            $created = $products->created_at;
            // dd($product);
        }
       
        return view('orders.orderSingleSeller',compact('user','quantity','product','price','order','userid'));

    }

    public function ordersbuyer($id){
        //get orders whose order_status is placed
        // $orders = DB::table('orders')->where([
        //     'user_id'=>$id,
        //     'order_status_id' =>2,
        //     ])->get();
            //foreach order, show the product name and description and total price.
            $orders = Order::join('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.id')
            ->join('order_items','order_items.order_id', '=', 'orders.id')
            // ->join('order_items','order_items.product_id', '=', 'products.id')
            ->where(['orders.user_id'=>$id,'orders.order_status_id'=>2])
            ->select('products.product_name', 'products.product_description','orders.id','order_items.price')
            ->get();
                     return view('orders.indexOBuyer',compact('orders','products','pricess'));
        }
            // dd($orders);
        // foreach($orders as $order){
        //     // $products = array();
        //         $productss = $order->product_id;
        //         // $orderid = $order->id;
        //         // $pricess = OrderItems::where([
        //         //         'order_id'=> $orderid,
        //         //         'product_id'=> $productss
        //         // ])->get();
             
        //         $products = Product::where('id',$productss)->get();
        //             foreach($products as $product){
        //                 $productsss = $product->product_name;
        //                 // dd($product);
        //                 // array_push($products,$product);
        //             // }
        //         // dd($order->product_id);
        //         // dd($products->product_name);
        //         // dd($products->product_name);
        //         // $products = Product::where('id',$productss)->get();
        //         // foreach($products as $product){
        //         //     $group = $product->product_name;
        //         //     $productid= $product->id;
        //             $pricess = DB::table('order_items')->select('price')->where([
        //                 'product_id'=>$productss,
        //                 'order_id'=>$id,
        //                 ])->get();
        //                 // dd($pricess);
        //             // $pricess = OrderItems::where('product_id',$productid)->select('price')->get();
        //             // dd($pricess);
                    
        //             foreach($pricess as $prices){
        //                 $price =$prices->price;
        //             }
        //         //     // dd($pricess);
        //         //     // $abs = $products->groupBy($group);
        //         //     // foreach($abs as $abc){
                        
        //             }
        //         // array_push($products,$product);
                    
        //         // }
        //         return view('orders.indexOBuyer',compact('orders','products','pricess'));
        // }
        // dd($products);
        // dd($product->prices);
       

    // }

    public function ordersbuyercomplete($id){
        // $orders = DB::table('orders')->where([
        //     'user_id'=>$id,
        //     'order_status_id' =>3,
        //     ])->get();
        // $orders = Order::where('user_id',$id)->select('order_status_id')->get();
        // $products =0;
        $orders = Order::join('products', 'products.id', '=', 'orders.product_id')
        ->select('orders.id')
        ->join('order_items','order_items.order_id', '=', 'orders.id')
        // ->join('order_items','order_items.product_id', '=', 'products.id')
        ->where(['orders.user_id'=>$id,'orders.order_status_id'=>3])
        ->select('products.product_name', 'products.product_description','orders.id','order_items.price')
        ->get();

        // $count =0;
        // foreach($orders as $order){
        //     if($order->order_status_id = 3){
        //         $productss = $order->product_id;
        //         $products = Product::where('id',$productss)->get();
        //         foreach($products as $product){
        //             $group = $product->product_name;
        //             $abs = $products->groupBy($group);
        //             foreach($abs as $abc){

        //             }
        //             // dd(boolean($order->order_status_id = 2));
        //         }
        //     }
        // }
        
        // dd($orders->order_status_id);
        return view('orders.indexOBuyerComplete',compact('orders','products'));
    }

    public function orderbuyerview($id){
        $productss = Product::where('id',$id)->get();
        foreach($productss as $products){
            $users = $products->user_id;
            $user = auth()->user()->find($users)->name;
            // dd($username);
        }
        return view('orders.buyerViewProduct',compact('productss','user'));
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
                $product = (request(['quantity'])['quantity']) * (json_encode($pricesss)); 
                // dd($product);
                OrderItems::create(array(
                    'order_id'=>json_encode($abcd),
                    'product_id'=>request(['product_id'])['product_id'],
                    'quantity'=>request(['quantity'])['quantity'],
                    'price'=>json_encode($product),
                    ));
                    // dd('okay');
                    // dd($abc);
                // }
               $productquantititess =  Product::where('id',request(['product_id'])['product_id'])->select('Product_quantity','id')->get();
                foreach($productquantititess as $productquantitites){
                    if($productquantitites->id = request(['product_id'])['product_id'] ){
                        // dd(($productquantitites->Product_quantity) - (request(['quantity'])['quantity']));
                        Product::where('id', request(['product_id'])['product_id'])
                                ->update([
                                    'Product_quantity' =>($productquantitites->Product_quantity) - (request(['quantity'])['quantity'])
                        ]);
                    }
                }
                    // dd($abc);
                    // $orders = Order::all();
                    $orders = Order::where('user_id',request(['user_id'])['user_id'])->get();
                    foreach($orders as $order){
                        $orderss = $order->product_id;
                        $productss = Product::where('id',$orderss)->get();
                    }

                   //check whether quantity is below aero so as to update status to be out of stock
                    $quantitycheck = Product::find(request(['product_id'])['product_id']);
                    $quantity = $quantitycheck->Product_quantity;
                    if(($quantity['quantity'])<"0")
                    {                    
                        $update = Product::find(request(['product_id'])['product_id'])
                                ->update([
                                    "product_status" => "2"
                                ]);
                    }

                    //  return view('orders.indexBuyer',compact('orders','productss','products'));
                    $user =request(['user_id']);
                    return $this->ordersbuyer($user);
                    // return redirect('/ordersbuyer/{{ Auth::user()["id"] }}');
                }
    //     }
    // }  

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
    public function reports($id)
    {
        $reports = Product::where('user_id',$id)
                        ->join('order_items','order_items.product_id', '=', 'products.id')
                        ->join('categories','categories.id', '=', 'products.category_id')
                        // ->select('category.name','products.product_name')
                        ->select('categories.category_name','products.product_name','order_items.quantity','order_items.price','products.id','order_items.order_id')
                        ->get();
                        $total =0;
                        foreach($reports as $report){
                            for($i=1; $i<$reports->count(); $i++){
                                $total +=$report->price;
                            }
                        }
                            // dd($total);
                        

        return view('reports.indexReports',compact('reports','total'));
    }

    public function productreports($id,$order){
        $productss = Product::find($id);
        $products=$productss->product_name;
        $productsid =$productss->id;
        $buyers =Order::where('product_id',$productsid)->get();
        foreach($buyers as $buyer){
            $buyerid = $buyer->user_id;
            $buyername = auth()->user()->find($buyerid)->name;
        }
        $quantitys =OrderItems::where([
            'product_id'=>$productss->id,
            'order_id'=>$order,
            ])->get();
        foreach($quantitys as $quantityss){
            $quantity= $quantityss->quantity;
            $price = $quantityss->price;
        }
                                // join('order_items', 'order_items.product_id', '=', 'products.id')
                                // ->join('orders','orders.id', '=', 'order_items.order_id')
                                // ->join('users','users.id', '=', 'orders.user_id')
                                // ->select('products.product_name','users.name','order_items.quantity','order_items.price')
                                // ->get();
        //    dd($productreport);
        return view('reports.productReport',compact('products','buyername','quantity','price'));
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
