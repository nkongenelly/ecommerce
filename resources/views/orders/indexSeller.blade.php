@extends('layoutsSeller')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>Order No.</th>
            <th>Buyer</th>
            <th>Product Name</th>
            <th>Product description</th>
            <th>Product Price</th>
            <th colspan="2">Action</th>
        </tr>
        @if(array($orders))
            @foreach($orders as $order)
                @if($order->order_status_id = 2)
                    <tr>
                        @foreach($products as $product)
                        
                            <td>{{ $order->id }}</td>
                            <td>{{ $buyer}}</td>
                            <td>{{ $product['product_name'] }}</td>
                                
                            <td>{{ $product['product_description'] }}</td>
                            <td>{{ $product['product_price'] }}</td>
                            <td>
                            <a href="/orderview/{{ $product['id'] }}/{{ $order->id }}" class="btn btn-warning">View</a>    
                            </td>
                            <td>
                                <a href="/orderview/{{ $product['id'] }}/{{ $order->id }}" class="btn btn-outline-success my-2 my-sm-0">Complete Orders</a>
                            </td>
                        @endforeach
                    </tr>
                    
                @endif
            @endforeach
        @endif
           
    
    </table>
    

@endsection

