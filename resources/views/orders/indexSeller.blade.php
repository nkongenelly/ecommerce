@extends('layoutsSeller')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Buyer</th>
            <th>Product Name</th>
            <th>Product description</th>
            <th>Product Price</th>
            <th colspan="2">Action</th>
            <th>Order Completed</th>
        </tr>
        @if(array($orders))
            @foreach($orders as $order)
                @if($order->order_status_id = 2)
                    <tr>
                        @foreach($products as $product)
                        
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $buyer}}</td>
                            <td>{{ $product['product_name'] }}</td>
                                
                            <td>{{ $product['product_description'] }}</td>
                            <td>{{ $product['product_price'] }}</td>
                            <td>
                            <a href="" class="btn btn-warning">View</a>    
                            </td>
                            <td>
                                <a href="/orders/create/{{ $product['id'] }}" class="btn btn-outline-success my-2 my-sm-0">Complete Orders</a>
                            </td>
                            <td>
                              
                                    @if($order->order_status_id = '3')
                                        <strong>Yes</strong>
                                    @else
                                        <strong>No</strong>
                                    @endif
                              
                            </td>  
                        @endforeach
                    </tr>
                    
                @endif
            @endforeach
        @endif
           
    
    </table>
    

@endsection

