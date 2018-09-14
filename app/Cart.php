<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\User;

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
        $storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item, 'product_id' => $id, 'product_name' => $item->price, 'product_description' => $item->price, 'product_price' => $item->price];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        
        $storedItem['quantity']++;
        $storedItem['price'] = $item->price * $storedItem['quantity'];
        $storedItem['product_id'] = $id;
        $storedItem['product_name'] = Product::find($id)->product_name;
        $storedItem['product_description'] = $item->product_description;
        $storedItem['product_price'] = $item->product_price;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;


    }
}