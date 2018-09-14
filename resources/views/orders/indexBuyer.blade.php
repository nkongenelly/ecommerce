@extends('layoutsBuyer')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product description</th>
            <th>No. of Orders</th>
            <th>Product Price @</th>
            <th colspan="2">Action</th>
            <th>Placed Order</th>
            
                @foreach($products as $item)
                    <tr>
                        <td>{{ $item['item']->id }}</td>
                        <td>{{ $item['item']->product_name }}</td>
                            
                        <td>{{ $item['item']->product_description }}</td>
                        <td><span class="badge">{{ $item['quantity'] }}</span></td>
                        <td>{{ $item['item']->product_price }}</td>
                        <td>
                            <a href="/orders/create/{{ $item['item']->id }}" class="btn btn-outline-success my-2 my-sm-0">Place Orders</a>
                        </td>
                        @foreach($orders as $order)
                        <td>
                            
                                @if($order->order_status_id = '1')
                                    <strong>No</strong>
                                @else
                                    <strong>Yes</strong>
                                @endif
                           
                        </td> 
                        @endforeach
                    </tr>
                 @endforeach
    
           
    
    </table>
    

@endsection

