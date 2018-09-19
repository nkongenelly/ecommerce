<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\User;
use App\Order;

class Cart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $product_name = null;
    public $product_description = 0;
    public $product_price = 0;
    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($item, $id) {
        // dd($item);
        $storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item, 'product_id' => $id, 'product_name' => $item->price, 'product_description' => $item->price, 'product_price' => $item->price, 'order_id' => $item->order_id];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        
        // $storedItem['editquantity']=$item->quantity;
        $storedItem['quantity']++;
        $storedItem['price'] = $item->price * $storedItem['quantity'];
        $storedItem['product_id'] = $id;
        $storedItem['product_name'] = Product::find($id)->product_name;
        $storedItem['product_description'] = $item->product_description;
        $storedItem['product_price'] = $item->product_price;
        $allorders=Order::latest()->get();
        // dd($allorders->first());
        if($allorders->first()!= null){
            // dd("null");
            // foreach($allorders->last() as $oneorder){
                if($allorders->first()->order_status_id == "1"){
                   
                    // dd('status 1');
                    $orderid = $allorders->first()->id;
                    $storedItem['order_id'] = $orderid;
                }
                if($allorders->first()->order_status_id == "3"){
                    // dd($allorders->first()->order_status_id);
                    // dd('status 2');
                    $orderid = ($allorders->first()->id)+1;
                    $status = 1;
                    $id = auth()->user()->id;
                    Order::create([
                        'user_id' => $id,
                        'order_status_id' =>$status,
                    ]);
                    // dd($orderid);
                    $storedItem['order_id'] = $orderid;
                }
                
            // }
        }else{
            // dd("not null");
            $storedItem['order_id'] = "1";
        }
        
        // $storedItem['order_id'] = $orderid;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;


    }
}