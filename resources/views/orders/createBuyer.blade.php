@extends('layoutsBuyer')

@section('content')
    <form action="/orders" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-control">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="order_status_id" value="{{ $orderstatus->id }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label>Product</label>
                <input type="text" class="form-control" value="{{ $product->product_name }}" name="quantity" disabled>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" value="{{ $product->product_price }}" name="price" disabled>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" class="form-control" name="quantity">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add to Cart</button>  
            </div>         
        </div>
    
    </form>

@endsection