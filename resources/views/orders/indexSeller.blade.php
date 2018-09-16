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
                    <tr>                        
                            <td>{{ $order->id }}</td>
                            <td>{{ $order['name']}}</td>
                            <td>{{ $order['product_name'] }}</td>
                                
                            <td>{{ $order['product_description'] }}</td>
                            <td>{{ $order['price'] }}</td>
                            <td>
                            <a href="/orderview/{{ $order['id'] }}/{{ $order->id }}" class="btn btn-warning">View</a>    
                            </td>
                            <td>
                                <a href="/orderview/{{ $order['id'] }}/{{ $order->id }}" class="btn btn-outline-success my-2 my-sm-0">Complete Orders</a>
                            </td>
                        
                    </tr>
                    
            
            @endforeach
        @endif
           
    
    </table>
    

@endsection

