@extends('layoutsBuyer')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>Order No.</th>
            <th>Product Name</th>
            <th>Product description</th>
            <th>Product Price</th>
        </tr>
        @if(array($orders))
        @foreach($orders as $order)
        @foreach($pricess as $price)
                    @if($order->order_status_id = 2)
                        <tr>
                            @foreach($products as $product)
                                                        
                                <td>{{ $order->id }}</td>
                                <td>{{ $product['product_name'] }}</td>
                                    
                                <td>{{ $product['product_description'] }}</td>
                                
                                    <td>{{ $price->price }}</td>
                               
                            @endforeach
                                
                            
                        </tr>
                        
                    @endif
                    @endforeach
            @endforeach
        @endif
           
    
    </table>
    

@endsection

